<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        $backups = [];
        $files   = Storage::files('backups');

        foreach ($files as $file) {
            $filename = basename($file);
            $path     = Storage::path($file);

            if (file_exists($path)) {
                $backups[] = [
                    'filename'   => $filename,
                    'size'       => $this->formatBytes(filesize($path)),
                    'created_at' => date('Y-m-d H:i:s', filemtime($path)),
                    'date'       => date('d M Y', filemtime($path)),
                    'time'       => date('H:i:s', filemtime($path)),
                ];
            }
        }

        // Sort by creation time (newest first)
        usort($backups, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $title = __('index.database_backups');
        return view('pages.backup.index', compact('backups', 'title'));
    }

    public function checkTodayBackup()
    {
        $today = now()->format('Y_m_d');
        $files = Storage::files('backups');

        foreach ($files as $file) {
            $filename = basename($file);
            if (strpos($filename, $today) === 0) {
                return response()->json(['exists' => true]);
            }
        }

        return response()->json(['exists' => false]);
    }

    private function formatBytes($size, $precision = 2)
    {
        $base     = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function manualBackup()
    {
        $filename = now()->format('Y_m_d_H_i_s') . '_iproduction.sql';
        $path     = storage_path("app/backups/$filename");

        try {
            $db = config('database.connections.mysql');

            $dumpCommand = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                escapeshellarg($db['username']),
                escapeshellarg($db['password']),
                escapeshellarg($db['host']),
                escapeshellarg($db['database']),
                escapeshellarg($path)
            );

            exec($dumpCommand, $output, $result);
            return response()->json([
                'success'  => $result === 0,
                'filename' => $filename,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function restoreBackup($filename)
    {
        $path = storage_path("app/backups/$filename");

        if (! file_exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        try {
            $db = config('database.connections.mysql');

            $dumpCommand = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > "%s"',
                escapeshellarg($db['username']),
                escapeshellarg($db['password']),
                escapeshellarg($db['host']),
                escapeshellarg($db['database']),
                $path
            );

            exec($dumpCommand, $output, $result);
            return response()->json([
                'success' => $result === 0,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getBackupDetails($filename)
    {
        $path = storage_path("app/backups/$filename");

        if (! file_exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Get current database tables for reference
        $tables     = DB::select('SHOW TABLES');
        $tableNames = [];

        foreach ($tables as $table) {
            $tableName    = current((array) $table);
            $tableNames[] = [
                'name' => $tableName,
                'rows' => DB::table($tableName)->count(),
            ];
        }

        return response()->json([
            'filename'     => $filename,
            'tables'       => $tableNames,
            'total_tables' => count($tableNames),
        ]);
    }

    public function deleteBackup($filename)
    {
        $path = "backups/$filename";

        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => true, 'message' => 'Backup deleted successfully.']);
        }

        return response()->json(['error' => 'File not found.'], 404);
    }
}

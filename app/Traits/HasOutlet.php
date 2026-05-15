<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

trait HasOutlet
{
    public static function bootHasOutlet()
    {
        static::addGlobalScope('outlet', function (Builder $builder) {
            if (Session::has('outlet_id')) {
                $builder->where('outlet_id', Session::get('outlet_id'));
            }
        });

        static::creating(function ($model) {
            if (Session::has('outlet_id')) {
                $model->outlet_id = Session::get('outlet_id');
            }
        });

        static::updating(function ($model) {
            if (Session::has('outlet_id')) {
                $model->outlet_id = Session::get('outlet_id');
            }
        });
    }
}

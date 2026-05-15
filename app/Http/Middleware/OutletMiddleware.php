<?php
namespace App\Http\Middleware;

use App\Outlet;
use Closure;
use Illuminate\Http\Request;

class OutletMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $outlet_id = session('outlet_id');
        $outlet    = Outlet::find($outlet_id);

        if (! $outlet) {
            return redirect()->route('outlets.index')->with(dangerMessage(trans('index.select_outlet')));
        }

        return $next($request);
    }
}

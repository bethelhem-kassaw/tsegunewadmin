<?php

namespace App\Http\Middleware;

use App\Models\UniqueVisitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountUniqueVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // retrieve the IP address of the user
        $ip_address = request()->ip();

        // check if the IP address already exists in your database in today
        // $visitor = UniqueVisitor::where('ip_adress', $ip_address)->whereDate('created_at', today())->first();

        // if ($visitor == null) {
        //     // the user has not visited your website
        //     UniqueVisitor::create([
        //         'ip_adress' => $ip_address,
        //     ]);
        // }
        return $next($request);
    }
}

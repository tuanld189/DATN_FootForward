<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Vourcher;
use Carbon\Carbon;

class CheckVourcherExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy tất cả các vourchers
        $vourchers = Vourcher::all();

        foreach ($vourchers as $vourcher) {
            // Nếu vourcher đã hết hạn, cập nhật is_active thành false
            if (Carbon::now()->isAfter($vourcher->end_date) && $vourcher->is_active) {
                $vourcher->update(['is_active' => false]);
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vendor;

class OnlineUser
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $expireTime = Carbon::now()->addSeconds(30);
            Cache::put('user-is-online' . auth()->user()->id, true, $expireTime);

            if (auth()->user() instanceof User) {
                User::findOrFail(auth()->user()->id)->update(['last_seen' => Carbon::now()]);
            } elseif (auth()->user() instanceof Vendor) {
                Vendor::findOrFail(auth()->user()->id)->update(['last_seen' => Carbon::now()]);
            }
        }

        return $next($request);
    }
}

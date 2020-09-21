<?php

namespace Laurel\CMS\Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class LockCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            settingsModule()->setting('admin.lock_admin_panel')
        ) {
            $token = auth()->user()->token();
            $diffInMinutes = now()->diffInMinutes($token->lock_at);

            if (!$this->checkLockingTime($request, $diffInMinutes)) {
                return $this->createLockResponse($request);
            }
        }
        return $next($request);
    }

    protected function checkLockingTime($request, int $diffInMinutes)
    {
        return $diffInMinutes >= settingsModule()->setting('admin.lock_after_minutes', 15);
    }

    protected function createLockResponse($request)
    {
        return $request->ajax() ?
            serviceResponse(401, false, 'auth.locked', [], 'Account locked. Login to continue work.')->respond() :
            redirect('auth.lock');
    }
}

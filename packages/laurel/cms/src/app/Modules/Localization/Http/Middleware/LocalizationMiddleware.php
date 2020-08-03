<?php

namespace Laurel\CMS\Modules\Localization\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Laurel\CMS\Modules\Localization\Exceptions\LocaleHasNotBeenFoundException;
use Laurel\CMS\Modules\Localization\LocalizationModule;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->input('lang', null);
        if (!$locale) {
            App::setLocale(LocalizationModule::instance()->getModuleConfig()['default_locale']);
        } else if (!in_array($locale, LocalizationModule::instance()->getModuleConfig()['locales'])) {
            throw new LocaleHasNotBeenFoundException("Locale \"{$locale}\" has not been found");
        } else {
            App::setLocale($locale);
        }

        return $next($request);
    }
}

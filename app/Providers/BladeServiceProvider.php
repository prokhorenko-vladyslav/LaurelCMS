<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('css', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = env('STYLES_FOLDER', '/css/') . $parameters[0];
                return "<link rel=\"stylesheet\" href=\"{$path}\">";
            } else {
                return '';
            }
        });

        Blade::directive('js', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = env('JS_FOLDER', '/js/') . $parameters[0];
                return "<script src=\"{$path}\">";
            } else {
                return '';
            }
        });

        Blade::directive('img', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = env('IMG_FOLDER', '/img/') . $parameters[0];
                $alt = $parameters[1] ?? '';
                return "<img src=\"{$path}\" alt=\"{$alt}\">";
            } else {
                return '';
            }
        });

        Blade::directive('cdnJS', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = $parameters[0];
                return "<script src=\"{$path}\" crossorigin=\"anonymous\"></script>";
            } else {
                return '';
            }
        });
    }

    private function getParameters($expression)
    {
        $parameters = explode(',', $expression);
        foreach ($parameters as &$parameter) {
            $this->clearQuotes($parameter);
        }
        return $parameters;
    }

    private function clearQuotes(&$parameter)
    {
        $parameter = str_replace(["\"", "'"], "", $parameter);
    }
}

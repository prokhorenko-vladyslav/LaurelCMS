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
                $id = $parameters[2] ?? '';
                $classes = $parameters[3] ?? '';
                return "<img id=\"{$id}\" class=\"{$classes}\" src=\"{$path}\" alt=\"{$alt}\">";
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

        Blade::directive('cdnCss', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = $parameters[0];
                return "<link href=\"{$path}\" rel=\"stylesheet\">";
            } else {
                return '';
            }
        });

        Blade::directive('imgUrl', function ($expression) {
            $parameters = $this->getParameters($expression);
            if (isset($parameters[0])) {
                $path = env('IMG_FOLDER', '/img/') . $parameters[0];
                return $path;
            } else {
                return '';
            }
        });

        Blade::directive('inputText', function ($expression) {
            $parameters = $this->getParameters($expression);
            $id = $parameters[0] ?? '';
            $classes = $parameters[1] ?? '';
            $name = $parameters[2] ?? '';
            $placeholder = $parameters[3] ?? '';
            return "<input id=\"{$id}\" class=\"{$classes}\" name=\"{$name}\" placeholder=\"{$placeholder}\">";
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
        $parameter = trim(str_replace(["\"", "'"], "", $parameter));
    }
}

<?php
    if (!function_exists("user")) {
        function user()
        {
            static $user = null;

            if (is_null($user) && is_null(auth()->user())) {
                $user = \App\Models\User::createGuest();
                return $user;
            } else {
                return $user ?? auth()->user();
            }
        }
    }

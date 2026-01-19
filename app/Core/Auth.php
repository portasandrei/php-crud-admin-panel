<?php

namespace App\Core;

class Auth
{
    protected static function request()
    {

        $adminLoggedIn = false;

        if (!$adminLoggedIn) {
            header('Location: /admin/login');
        }
        var_dump("Auth core controller");
    }
}
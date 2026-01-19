<?php

namespace App\Core;

class Auth
{
    protected static function check(): void
    {
        $adminLoggedIn = false;

        if (!$adminLoggedIn) {
            header('Location: /admin/login');
            exit();
        }
    }
}
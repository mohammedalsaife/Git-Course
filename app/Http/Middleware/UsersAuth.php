<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UsersAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        function pc_validate($user, $pass)
        {
            /* replace with appropriate username and password checking, such as checking a database */
            $users = array('mohammed' => 'password', 'adam' => '8HEj838');
            if (isset($users[$user]) && ($users[$user] == $pass)) {
                return true;
            } else {
                return false;
            }
        }

        if (!pc_validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            header('WWW-Authenticate: Basic realm="My Website"');
            header('HTTP/1.0 401 Unauthorized');
            echo "You need to enter a valid username and password.";
            exit;
        }

        if (!pc_validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
            $realm = 'My Website for ' . date('Y-m-d');
            header('WWW-Authenticate: Basic realm="' . $realm . '"');
            header('HTTP/1.0 401 Unauthorized');
            echo "You need to enter a valid username and password.";
            exit;
        }



        return $next($request);
    }
}

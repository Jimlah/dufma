<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Tools\Auth;
use App\Providers\UsersProvider;

class CheckAuthMiddleware implements MiddlewareInterface
{
    /**
    * Trigger middleware event
    *
    * @param Request $request
    * @param array|null $args
    * @return mixed
    */
    public function trigger(Request $request, ?array $args = null)
    {   
        $user = Auth::user();

        
       if ($user) {
        if($user->access() == UsersProvider::ACCESS_ADMIN) {
            return redirect('/dashboard/admin');

        }

        if($user->access() == UsersProvider::ACCESS_ORGANIZATION) {
            return redirect('/dashboard/organization');
        }

        if($user->access() == UsersProvider::ACCESS_EMPLOYEE) {
            return redirect('/dashboard/employee');
        }

        if($user->access() == UsersProvider::ACCESS_INVESTOR) {
            return redirect('/dashboard/investor');
        }
       }
        
        return $request;
    }
}
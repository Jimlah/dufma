<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Interfaces\MiddlewareInterface;
use App\Providers\UsersProvider;

class AdminMiddleware implements MiddlewareInterface
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
        $user = $request->user();
        $access = $user->access();
        if(!( $access == UsersProvider::ACCESS_ADMIN)){
            return redirect('/404');
        }  
        return $request;
    }
}
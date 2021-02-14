<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Tools\Auth;

class Authentication implements MiddlewareInterface
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
        if(!$user){
            Auth::logout();
            return redirect('/sign_in');
        }

        if(!$user->status()){
            Auth::logout();
            $msg = 'You have been disabled contact the customer care for more info';
            return response()->withSession('msg', $msg)->redirect('/sign_in');
        }

        $request->setCustomMethod('user', fn() => $user);

        return $request;
    }
}
<?php

namespace App\Controllers\Auth;

use App\Core\Exceptions\AuthException;
use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;
use App\Core\Interfaces\InputInterface;
use App\Core\Misc\InputValidator;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

class LoginController extends Controller
{
    public function login(Request $request, Response $response)
    {   
        $userid = $request->input('username');
        $password = $request->input('password');


        $field = $userid->isEmail() ? 'email' : 'username';

        
        try {
            Auth::attempt([
                $field => $userid,
                'secret_key' => $password,
            ]);
        } catch (AuthException $th) {
            return $response->withSession('msg', $th->getMessage())->redirect($request->url()->getPath());
        }

        $user = Auth::user();

        $access = $user->access();
        $status = $user->status();

        // Account Status

        if($status == UsersProvider::STATUS_INACTIVE){
            return $response->withSession('msg', 'You are inactive Contact the Admin for more details')->redirect($request->url()->getPath());
        }

        // Access Status
        $msg = 'You have Successfully login';

        if($access == UsersProvider::ACCESS_ADMIN){
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/admin/');
        }

        if($access == UsersProvider::ACCESS_ORGANIZATION){
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/organization');
        }

        if($access == UsersProvider::ACCESS_EMPLOYEE){
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/empolyee');
        }

        if($access == UsersProvider::ACCESS_INVESTOR){
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/investor');
        }


        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
        
    }

}
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
        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        You have Successfully login
    </div>';

        if($access == UsersProvider::ACCESS_ADMIN){
            return $response->withSession('msg', $msg)->redirect('/dashboard/admin/');
        }

        if($access == UsersProvider::ACCESS_ORGANIZATION){
            return $response->withSession('msg', $msg)->redirect('/dashboard/organization');
        }

        if($access == UsersProvider::ACCESS_EMPLOYEE){
            return $response->withSession('msg', $msg)->redirect('/dashboard/empolyee');
        }

        if($access == UsersProvider::ACCESS_INVESTOR){
            return $response->withSession('msg', $msg)->redirect('/dashboard/investor');
        }


        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
        
    }

}
<?php

namespace App\Controllers\Auth;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;
use App\Core\Misc\InputValidator;
use App\Core\Exceptions\AuthException;

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
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/employee');
        }

        if($access == UsersProvider::ACCESS_INVESTOR){
            return $response->withSession('msg', [$msg, 'alert'])->redirect('/dashboard/investor');
        }


        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
        
    }

    public function recover(Request $request, Response $response)
    {
        $email = $request->input('email');

        InputValidator::init();

        $email->validate('required');
        

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        $user = UsersModel::findBy('email', $email);

        if(!$user){
            $msg = "Account not found";
            return $response->withSession('msg', [$msg, 'error'])->redirect($request->url()->getPath());
        }

        $password = generate_token(4);

        UsersModel::findByPrimaryKeyAndUpdate($user->id, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $context = array(
            'user' => $user,
            'password' => $password
        );

        $message = view('dashboard.emails.password-recovery', $context, false, true);
        mailer($email, 'Password Recovery', $message);

        $msg = 'Check your email to see your recovery password';


        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }
}
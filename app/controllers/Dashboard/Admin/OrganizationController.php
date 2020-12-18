<?php

namespace App\Controllers\Dashboard\Admin;

use App\Controllers\Dashboard\SendMailController;
use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;
use App\Core\Misc\InputValidator;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class OrganizationController extends Controller
{
    public function display(Request $request, Response $response)
    {
        Auth::user();
        $org = UsersModel::select()
            ->where('access', UsersProvider::ACCESS_ORGANIZATION)
            ->fetchAll();
        return $response->view('/dashboard/admin/organization', [
            'org' => $org
        ]);
    }

    public function registerOrg(Request $request, Response $response)
    {
        $user = $request->user();
        $username = $request->input('username');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password1 = $request->input('password1');
        $access = UsersProvider::ACCESS_ORGANIZATION;
        $status = UsersProvider::STATUS_ACTIVE;





        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                    // die();
                }
                if (UsersModel::findby($field, $validator->getValue())) {

                    $validator->attachError($message);
                }
            }

        ]);

        $username->validate('required')->uniqueField('username', 'Username has already been registered');
        $lastname->validate('required');
        $firstname->validate('required');
        $email->validate('required')->uniqueField('email', 'Email has already been registered');
        $password->validate('required')->equals($password1, "Password does not match");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        $message = "Thank you for applying to for this Application.
                    Username: $username 
                    Email: $email 
                    Password: $password  
                    goto http://fmcdufma.demisho.com.ng/sign_in to login
                    and make sure you change your password immediately";


        $msgerror = $mail = SendMailController::send(
            $email,
            $message
        );



        UsersModel::createEntry([
            'userid' => $user->id(),
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'access' => $access,
            'status' => $status
        ]);

        $msg = 'You have successfully loggedd in';

        if ($msgerror) {

            $msg = $msgerror;
        }

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }
}

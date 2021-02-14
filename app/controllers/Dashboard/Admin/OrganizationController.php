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
        $org = UsersModel::findAllBy('access', UsersProvider::ACCESS_ORGANIZATION);

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
        $access = UsersProvider::ACCESS_ORGANIZATION;
        $status = UsersProvider::STATUS_ACTIVE;


        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
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


        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }


        $password = generate_token(4);


        $id = UsersModel::createEntry([
            'userid' => $user->id(),
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'access' => $access,
            'status' => $status
        ]);

        $user = UsersModel::findByPrimaryKey($id);

        $context = array(
            'user' => $user,
            'password' => $password
        );
        $message = view('dashboard.emails.account-details', $context, false, true);
        mailer($email, 'Login Details', $message);

        $msg = 'You have successfully registered a new user';
        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function disable(Request $request, Response $response)
    {
        $id = $request->id;
        $status = $request->status;

        UsersModel::findByPrimaryKeyAndUpdate($id, [
            'status' => !$status
        ]);

        $employees = UsersModel::findAllBy('userid', $id);

        foreach ($employees as $employee) {
            UsersModel::findByPrimaryKeyAndUpdate($employee->id, [
                'status' => !$status
            ]);
        }

        $msg = 'You have successfully changed the user';
        return $response->withSession('msg', [$msg, 'alert'])-redirect('/dashboard/admin/organization');
    }
}

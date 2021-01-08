<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Core\Tools\Auth;
use App\Models\UsersModel;
use App\Providers\UsersProvider;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class FunctionController extends Controller
{
    public function logout(Request $request, Response $response)
    {
        Auth::logout();
        return $response->redirect('/');
    }



    public function registerEmp(Request $request, Response $response)
    {
        $user = $request->user();
        $username = $request->input('username');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password1 = $request->input('password1');
        $access = UsersProvider::ACCESS_EMPLOYEE;
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

        $msg = 'You have successfully logrd in';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }


    public function edit(Request $request, Response $response)
    {
        $user = $request->user();
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $id = $request->input('id');
        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                }
                if (UsersModel::findBy($field, $validator->getValue())) {

                    $validator->attachError($message);
                }
            }

        ]);

        $lastname->validate('required');
        $firstname->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        UsersModel::findByPrimaryKeyAndUpdate($id, [
            'userid' => $user->id(),
            'firstname' => $firstname,
            'lastname' => $lastname,
        ]);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = "You have success fully updated your details";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->input('id');
        UsersModel::findByPrimaryKeyAndRemove($id);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = "You have successfully deleted";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    /**
     * @param $num number of colors to generate
     * 
     * @return array
     */
    public function genColor($num)
    {
        $colors =[];
        for ($i = 0; $i < $num; $i++) {
            $hex = '#';

            //Create a loop.
            foreach (array('r', 'g', 'b') as $color) {
                //Random number between 0 and 255.
                $val = mt_rand(0, 255);
                //Convert the random number into a Hex value.
                $dechex = dechex($val);
                //Pad with a 0 if length is less than 2.
                if (strlen($dechex) < 2) {
                    $dechex = "0" . $dechex;
                }
                //Concatenate
                $hex .= $dechex;
            }

            $colors[] = $hex;
        };

        return $colors;
    }
}

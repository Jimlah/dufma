<?php

namespace App\Controllers\Dashboard\Admin;

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
        return $response->view('/dashboard/admin/organization',[
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


        $mail = $this->sendMail($request, $response);

        dnd($mail);

        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message){
                if($validator->getValue() == ''){
                    return null;
                    // die();
                    }
                if (UsersModel::findby($field, $validator->getValue())) {
                    
                    $validator->attachError($message);
                }
                
            }
            
        ]);
        
        $username->validate('required')->uniqueField('username','Username has already been registered');
        $lastname->validate('required');
        $firstname->validate('required');
        $email->validate('required')->uniqueField('email','Email has already been registered');
        $password->validate('required')->equals($password1, "Password does not match");

        if(!InputValidator::isValid()){
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

    public function sendMail(Request $request, Response $response)
    {
        $transport = (new Swift_SmtpTransport('mail.dufma.ng', 25))
                    ->setUsername('admin@fmc.dufma.ng')
                    ->setPassword('Ademola789@');
        
        $mailer = new Swift_Mailer($transport);


        $message = (new Swift_Message('WonderFul Subject'))
                    ->setFrom(['admin@fmc.dufma.ng' => 'Dufma'])
                    ->setTo(['abdullahij951@gmail.com' => 'Abdullahi'])
                    ->setBody('Here is the message itself');


        $result = $mailer->send($message);
    }
}
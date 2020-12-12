<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Core\Tools\Auth;
use App\Models\UsersModel;
use App\Providers\UsersProvider;

class FunctionController extends Controller
{
    public function logout(Request $request, Response $response)
    {   
        Auth::logout();
        return $response->redirect('/');
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
            $msg='';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] .'
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());

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
            $msg='';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] .'
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());

    }


    public function edit(Request $request, Response $response)
    {  
        $user = $request->user();
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $id = $request->input('id');
        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message){
                if($validator->getValue() == ''){
                    return null;
                    }
                if (UsersModel::findBy($field, $validator->getValue())) {
                    
                    $validator->attachError($message);
                }
                
            }
            
        ]);
        
        $lastname->validate('required');
        $firstname->validate('required');

        if(!InputValidator::isValid()){
            $errors = InputValidator::getErrors();
            $msg='';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] .'
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
        }

        UsersModel::findByPrimaryKeyAndUpdate( $id, [
            'userid' => $user->id(),
            'firstname' => $firstname,
            'lastname' => $lastname,
        ]);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully updated '. $firstname .' Data
            </div>';

        return $response->withSession('msg', $msg)->redirect($url);

    }

    public function delete(Request $request, Response $response)
    {   
        $id = $request->input('id');
        UsersModel::findByPrimaryKeyAndRemove($id);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Deleted the user
            </div>';

        return $response->withSession('msg', $msg)->redirect($url);
    }
}
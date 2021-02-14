<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\ProfileModel;
use App\Providers\UsersProvider;

class EmployeeController extends Controller
{
    public function employee(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $userid = $user->id();
        $emp = UsersModel::select()
            ->where('access', UsersProvider::ACCESS_EMPLOYEE)
            ->and('userid', $userid)
            ->fetchAll();
        return $response->view('/dashboard/organization/employee', [
            'emp' => $emp
        ]);
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

        $msg = 'You have successfully Registered';

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

    // public function deleteEmpl(Request $request, Response $response)
    // {
    //     $id = $request->input('id');
    //     UsersModel::findByPrimaryKeyAndRemove($id);

    //     $url = explode('/', $request->url()->getPath());
    //     array_pop($url);
    //     $url = implode('/', $url);

    //     $msg = "You have successfully deleted";

    //     return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    // }

    public function disable(Request $request, Response $response)
    {
        $id = $request->id;
        $status = $request->status;

        UsersModel::findByPrimaryKeyAndUpdate($id, [
            'status' => !$status
        ]);

        $msg = 'You have successfully changed the user';
        return $response->withSession('msg', [$msg, 'alert'])-redirect('/dashboard/organization/employee');
    }

    public function displayWorker(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();

        $worker = ProfileModel::select()
            ->where('orgid', $user->id())
            ->fetchAll();

        return $response->view('/dashboard/organization/worker', [
            'worker' => $worker
        ]);
    }


    public function addWorker(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->id();
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $address = $request->input('address');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $department = $request->input('department');
        $salary = $request->input('salary');
        $bkacct = $request->input('bkacct');
        $bkname = $request->input('bkname');
        $contract_type = $request->input('contract_type');
        $phone_no = $request->input('phone_no');

        InputValidator::init();

        $firstname->validate('required');
        $firstname->validate('required');
        $gender->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        ProfileModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'gender' => $gender,
            'email' => $email,
            'department' => $department,
            'salary' => $salary,
            'bkacct' => $bkacct,
            'bkname' => $bkname,
            'contract_type' => $contract_type,
            'phone_no' => $phone_no
        ]);


        $msg = "You have successfully add workers details";

        $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function editWorker(Request $request, Response $response)
    {
        Auth::user();

        $id = $request->input('id');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $address = $request->input('address');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $department = $request->input('department');
        $salary = $request->input('salary');
        $bkacct = $request->input('bkacct');
        $bkname = $request->input('bkname');
        $contract_type = $request->input('contract_type');
        $phone_no = $request->input('phone_no');

        ProfileModel::findByPrimaryKeyAndUpdate($id,[
            'firstname' => $firstname,
            'lastname' => $lastname,
            'address' => $address,
            'gender' => $gender,
            'email' => $email,
            'department' => $department,
            'salary' => $salary,
            'bkacct' => $bkacct,
            'bkname' => $bkname,
            'contract_type' => $contract_type,
            'phone_no' => $phone_no
        ]);


        $referer_uri = $request->getServer()->get('http_referer');

        $msg = "You have successfully updated workers details";

        $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
    }

    public function delete(Request $request, Response $response)
    {
        Auth::user();
        
        $id = $request->input('id');
        ProfileModel::findByPrimaryKeyAndRemove($id);

        $referer_uri = $request->getServer()->get('http_referer');

        $msg = "You have successfully deleted workers details";

        $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
    }
}

<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\AssetModel;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\AssetProvider;
use App\Providers\UsersProvider;
use App\Core\Misc\InputValidator;
use App\Controllers\Dashboard\SendMailController;
use App\Models\ProfileModel;

class IndexController extends Controller
{
    public function dispaly(Request $request, Response $response)
    {

        $response->view('/dashboard/organization/index', []);
    }

    public function displayProfile(Request $request, Response $response)
    {

        Auth::user();
        $user = $request->user();

        $profile = ProfileModel::findBy('userid', $user->id());


        $response->view('/dashboard/organization/profile', [
            'profile' => $profile
        ]);
    }

    public function updateUser(Request $request, Response $response)
    {
        $referer_uri = $request->getServer()->get('http_referer');
        
        $user = $request->user();
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password1 = $request->input('password1');




        InputValidator::init();

        $lastname->validate('required');
        $firstname->validate('required');
        $password->validate('required')->equals($password1, "Password does not match");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($referer_uri, [], true);
        }

        $message = "You have successfully Updated your profile. If it was not done by you pls contact the admin immediately.
                    goto http://fmcdufma.demisho.com.ng/sign_in to login
                    and make sure you change your password immediately";


        $msgerror = $mail = SendMailController::send(
            $email,
            $message
        );



        UsersModel::findByPrimaryKeyAndUpdate($user->id(), [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $msg = 'You have successfully changed your password';

        if ($msgerror) {

            $msg = $msgerror;
        }

        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
        
    }

    public function updateProfile(Request $request, Response $response)
    {
        Auth::user();

        $referer_uri = $request->getServer()->get('http_referer');
        $user = $request->user();

        $companyname = $request->input('companyname');
        $address = $request->input('address');
        $phone_no = $request->input('phone');
        $bkname = $request->input('bkname');
        $bkacct = $request->input('bkacct');

        InputValidator::init();

        $companyname->validate('required');
        $address->validate('required');
        $phone_no->validate('required');
        $bkname->validate('required');
        $bkacct->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($referer_uri, [], true);
        }

        $check = ProfileModel::findBy('userid', $user->id());

        if(!$check){
            ProfileModel::createEntry([
                'userid' => $user->id(),
                'companyname' => $companyname,
                'address' => $address,
                'phone_no' => $phone_no,
                'bkname' => $bkname,
                'bkacct' => $bkacct
            ]);

            $msg = 'You have successfully updated your profile'; 

        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
        }

        $id = $check->id;

        ProfileModel::findByPrimaryKeyAndUpdate($id, [
            'userid' => $user->id(),
                'companyname' => $companyname,
                'address' => $address,
                'phone_no' => $phone_no,
                'bkname' => $bkname,
                'bkacct' => $bkacct
        ]);

        $msg = 'You have successfully updated your profile'; 

        return $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);
    }


    public function displayInventory(Request $request, Response $response)
    {
        $user = $request->user();
        $orgid = $user->id();

        $items = AssetModel::select('count(*) sum, table_type')
            ->where('orgid', $orgid)
            ->groupBy('table_type')
            ->fetchAll();

        $total = AssetModel::select('count(*) sum')
            ->where('orgid', $orgid)
            ->fetchOne();

        
        
        $response->view('/dashboard/organization/inventory-dash', [
            'items' => $items,
            'total' => $total
        ]);
    }

}

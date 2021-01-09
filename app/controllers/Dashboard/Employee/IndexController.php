<?php

namespace App\Controllers\Dashboard\Employee;

use App\Controllers\Dashboard\FunctionController;
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
use App\Models\ExpLogModel;
use App\Models\FpmModel;
use App\Models\ProfileModel;
use App\Providers\ExpLogProvider;
use App\Providers\FpmProvider;

class IndexController extends Controller
{
    public function display(Request $request, Response $response)
    {
        $user = $request->user();
        $asset = AssetModel::select('count(*) sum, table_type')
            ->where('orgid', $user->userid())
            ->groupBy('table_type')
            ->fetchAll();
        $usernum = UsersModel::select('count(*) sum')
            ->where('userid', $user->userid())
            ->where('status', UsersProvider::STATUS_ACTIVE)
            ->fetchAll();

        $lastuser = UsersModel::select()
            ->where('userid', $user->userid())
            ->getLast('created_at');

        $worker = ProfileModel::select('count(*) sum')
            ->where('orgid', $user->userid())
            ->fetchAll();

        $lastworker = ProfileModel::select()
            ->where('orgid', $user->userid())
            ->getLast('created_at');

        $arr = array(
            AssetProvider::BUILDING => 'BUILDING',
            AssetProvider::MACHINERY => 'MACHINERY',
            AssetProvider::VEHICLE => 'VEHICLE',
            AssetProvider::LAND => 'LAND',
            AssetProvider::PRODUCT => 'PRODUCT',
            AssetProvider::OTHER_ASSET => 'OTHER_ASSET',
            AssetProvider::EQUIPMENT => 'EQUIPMENT',
            AssetProvider::GOODS => 'GOODS',
        );

        $assetTable = [];
        $assetTableSum = [];

        foreach ($asset as $value) {
            $assetTable[] = $value->table_type;
            $assetTableSum[] = $value->sum;
        }


        $fun = new FunctionController();
        $assetColor = $fun->genColor(5);

        $assetColor = implode(',', $assetColor);
        $assetTable = implode(',', $assetTable);
        $assetTable = str_replace(array_keys($arr), $arr, $assetTable);
        $assetTableSum = implode(',', $assetTableSum);


        $response->view('/dashboard/employee/index', [
            'assetTable' => $assetTable,
            'assetTableSum' => $assetTableSum,
            'assetTableColor' => $assetColor,
            'usernum' => $usernum[0]->sum + 1,
            'lastuser' => $lastuser,
            'worker' => $worker[0]->sum,
            'lastworker' => $lastworker
        ]);
    }

    public function displayProfile(Request $request, Response $response)
    {

        Auth::user();
        $user = $request->user();

        $profile = ProfileModel::findBy('userid', $user->id());


        $response->view('/dashboard/employee/profile', [
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

        $phone_no = $request->input('phone');
        $bkname = $request->input('bkname');
        $bkacct = $request->input('bkacct');

        InputValidator::init();
        $phone_no->validate('required');
        $bkname->validate('required');
        $bkacct->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($referer_uri, [], true);
        }

        $check = ProfileModel::findBy('userid', $user->id());

        if (!$check) {
            ProfileModel::createEntry([
                'userid' => $user->id(),
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
        $orgid = $user->userid();

        $items = AssetModel::select('count(*) sum, table_type')
            ->where('orgid', $orgid)
            ->groupBy('table_type')
            ->fetchAll();

        $total = AssetModel::select('count(*) sum')
            ->where('orgid', $orgid)
            ->fetchOne();

        $response->view('/dashboard/employee/inventory-dash', [
            'items' => $items,
            'total' => $total
        ]);
    }

    public function displayMonitory(Request $request, Response $response)
    {
        $user = $request->user();
        $orgid = $user->userid();

        $items = FpmModel::select('count(*) sum, fpm')
            ->where('orgid', $orgid)
            ->groupBy('fpm')
            ->fetchAll();

        $total = FpmModel::select('count(*) sum')
            ->where('orgid', $orgid)
            ->fetchOne();

        $arr = array(
            FpmProvider::FPM_FIELD => 'FIELD',
            FpmProvider::FPM_PEN => 'PEN',
            FpmProvider::FPM_FACILITY => 'FACILITY'
        );

        foreach ($items as $key) {
            $key->fpm = $arr[$key->fpm];
        }


        $response->view('/dashboard/employee/monitory-dash', [
            'items' => $items,
            'total' => $total
        ]);
    }

    public function displayFinancial(Request $request, Response $response)
    {
        $user = $request->user();
        $orgid = $user->userid();

        $items = ExpLogModel::select('count(*) sum, type')
            ->where('orgid', $orgid)
            ->groupBy('type')
            ->fetchAll();

        $total = ExpLogModel::select('count(*) sum')
            ->where('orgid', $orgid)
            ->fetchOne();


        $arr = array(
            ExpLogProvider::BUILDING_MAINTENANCE => 'BUILDNG MAINTENANCE',
            ExpLogProvider::MACHINERY_MAINTENANCE => 'MACHINERY MAINTENANCE',
            ExpLogProvider::VEHICLE_MAINTENANCE => 'VECHILE MAINTENANCE',
            ExpLogProvider::UTILITIES => 'UTILITIES',
            ExpLogProvider::ADVERT => 'ADVERT',
            ExpLogProvider::PURCHASES => 'PURCHASES',
            ExpLogProvider::RENT => 'RENT',
            ExpLogProvider::LEGAL_FEES => 'LEGAL FEES',
            ExpLogProvider::POWER => 'POWER',
            ExpLogProvider::SALARY => 'SALARY',
            ExpLogProvider::INSURANCE => 'INSURANCE',
            ExpLogProvider::SECURITY => 'SECURITY',
        );

        foreach ($items as $key) {
            $key->fpm = $arr[$key->type] ?? 'Empty';
        }


        $response->view('/dashboard/employee/financial-dash', [
            'items' => $items,
            'total' => $total
        ]);
    }
}

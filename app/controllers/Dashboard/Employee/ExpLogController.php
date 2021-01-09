<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Tools\Auth;
use App\Models\AssetModel;
use App\Models\ExpLogModel;
use App\Providers\AssetProvider;
use App\Providers\ExpLogProvider;
use App\Providers\UsersProvider;

class ExpLogController extends Controller
{
    public function addExpLog(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->userid();
        $assetid = $request->input('assetid');
        $category = $request->input('category');
        $name = $request->input('name');
        $description = $request->input('description');
        $amount = $request->input('amount');
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $duration_start = $request->input('duration_start');
        $duration_end = $request->input('duration_end');

        $url = $request->url()->getPath();

        $type_arr = [
            "/dashboard/employee/main-build" => ExpLogProvider::BUILDING_MAINTENANCE,
            "/dashboard/employee/main-vehi" => ExpLogProvider::VEHICLE_MAINTENANCE,
            "/dashboard/employee/main-mach" => ExpLogProvider::MACHINERY_MAINTENANCE,
            "/dashboard/employee/utility" => ExpLogProvider::UTILITIES,
            "/dashboard/employee/advert" => ExpLogProvider::ADVERT,
            "/dashboard/employee/purchases" => ExpLogProvider::PURCHASES,
            "/dashboard/employee/rent" => ExpLogProvider::RENT,
            "/dashboard/employee/legal" => ExpLogProvider::LEGAL_FEES,
            "/dashboard/employee/power" => ExpLogProvider::POWER,
            "/dashboard/employee/salary" => ExpLogProvider::SALARY,
            "/dashboard/employee/insurance" => ExpLogProvider::INSURANCE,
            "/dashboard/employee/security" => ExpLogProvider::SECURITY,
            "/dashboard/employee/raw_mat" => ExpLogProvider::RAW_MATERIALS,
        ];

        $type =  $type_arr[$url];


        ExpLogModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'assetid' => $assetid,
            'category' => $category,
            'name' => $name,
            'description' => $description,
            'amount' => $amount,
            'quantity' => $quantity,
            'status' => $status,
            'duration_start' => $duration_start,
            'duration_end' => $duration_end,
            'type' => $type 
        ]);

        $referer_uri = $request->getServer()->get('http_referer');

        $msg = 'You have successfully submitted your data';

        $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);

    }


    public function updateExpLog(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $id = $request->url()->getQuery('id');
        $assetid = $request->input('assetid');
        $category = $request->input('category');
        $name = $request->input('name');
        $description = $request->input('description');
        $amount = $request->input('amount');
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $duration_start = $request->input('duration_start');
        $duration_end = $request->input('duration_end');


        ExpLogModel::findByPrimaryKeyAndUpdate($id, [
            'assetid' => $assetid,
            'category' => $category,
            'name' => $name,
            'description' => $description,
            'amount' => $amount,
            'quantity' => $quantity,
            'status' => $status,
            'duration_start' => $duration_start,
            'duration_end' => $duration_end,
        ]);

        $referer_uri = $request->getServer()->get('http_referer');

        $msg = 'You have successfully updated your data';

        $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);

    }

    public function deleteExpLog(Request $request, Response $response)
    {
        Auth::user();

        $id = $request->input('id');
        
        ExpLogModel::findByPrimaryKeyAndRemove($id);

        $referer_uri = $request->getServer()->get('http_referer');

        $msg = 'You have successfully deleted your data';

        $response->withSession('msg', [$msg, 'alert'])->redirect($referer_uri, [], true);

    }

    public function mainBuild(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Building Maintenace';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::BUILDING_MAINTENANCE)
            ->map()
            ->fetchAll();

        $table = [
            'assetid' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }

    public function mainVehi(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Vehicle Maintenace';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::VEHICLE_MAINTENANCE)
            ->map()
            ->fetchAll();

        $table = [
            'assetid' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::VEHICLE)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }

    public function mainMach(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Machinery Maintenace';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::MACHINERY_MAINTENANCE)
            ->map()
            ->fetchAll();

        $table = [
            'assetid' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::MACHINERY)
            ->map()
            ->fetchAll();


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }

    public function utility(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Utility';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::UTILITIES)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }

    public function advert(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'advert';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::ADVERT)
            ->map()
            ->fetchAll();

        $table = [
            'category' => 'category',
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_date' => 'date'
        ];

        $category = ['TV', 'Radio', 'Social Media', 'Print', 'Other'];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset,
            'category' => $category
        ]);
    }


    public function purchases(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'purchase';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::PURCHASES)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'quantity' => 'quantity',
            'total' => 'total',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }


    public function rent(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Rent';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::RENT)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'quantity' => 'quantity',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }

    public function legal(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Legal Fees';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::LEGAL_FEES)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }


    public function power(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Power';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::POWER)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }


    public function salary(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Salary';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::SALARY)
            ->map()
            ->fetchAll();

        $table = [
            'name' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }


    public function insurance(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Insurance';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::INSURANCE)
            ->map()
            ->fetchAll();

        $table = [
            'assetid' => 'item',
            'name' => 'name',
            'amount' => 'amount',
            'duration_start' => 'duration_start',
            'duration_end' => 'duration_end',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }


    public function security(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Security';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->userid())
            ->and('type', ExpLogProvider::SECURITY)
            ->map()
            ->fetchAll();

        $table = [
            'assetid' => 'name',
            'description' => 'description',
            'amount' => 'amount',
            'created_at_time' => 'time',
            'created_at_date' => 'date'
        ];

        $category = ['CCTV Consoles', 'Gatemen', 'Watchmen', 'Other'];

        $asset = AssetModel::select()
            ->where('orgid', $user->userid())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/employee/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset,
            'category' => $category
        ]);
    }
   


}

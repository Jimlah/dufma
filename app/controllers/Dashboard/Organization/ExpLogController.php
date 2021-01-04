<?php

namespace App\Controllers\Dashboard\Organization;

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
    public function mainBuild(Request $request, Response $response)
    {
        Auth::user();

        $user = $request->user();
        $name = 'Building Maintenace';
        $exp = ExpLogModel::select()
            ->where('orgid', $user->id())
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
            ->where('orgid', $user->id())
            ->and('table_type', AssetProvider::BUILDING)
            ->map()
            ->fetchAll();;


        $response->view('/dashboard/organization/explog', [
            'name' => $name,
            'exp' => $exp,
            'table' => $table,
            'asset' => $asset
        ]);
    }
    
    public function addExpLog(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->id();
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

        $type = ExpLogProvider::BUILDING_MAINTENANCE;

        $type_arr = [
            "/dashboard/organization/main-build" => ExpLogProvider::BUILDING_MAINTENANCE,
            "/dashboard/organization/vehi-build" => ExpLogProvider::VEHICLE_MAINTENANCE,
            "/dashboard/organization/mach-build" => ExpLogProvider::MACHINERY_MAINTENANCE,
            "/dashboard/organization/utility" => ExpLogProvider::UTILITIES,
            "/dashboard/organization/advert" => ExpLogProvider::ADVERT,
            "/dashboard/organization/purchaces" => ExpLogProvider::PURCHASES,
            "/dashboard/organization/rent" => ExpLogProvider::RENT,
            "/dashboard/organization/legal" => ExpLogProvider::LEGAL_FEES,
            "/dashboard/organization/power" => ExpLogProvider::POWER,
            "/dashboard/organization/salary" => ExpLogProvider::SALARY,
            "/dashboard/organization/insurance" => ExpLogProvider::INSURANCE,
            "/dashboard/organization/security" => ExpLogProvider::SECURITY,
            "/dashboard/organization/raw_mat" => ExpLogProvider::RAW_MATERIALS,
        ];

        $type = in_array($url, $type_arr) ? $type_arr[$url] : null;

        // if ($type == null ) {
        //     $response->withSession('msg', ['Unable to submit', 'alert'])->redirect($request->url()->getPath);
        // }

        dnd($type);
    }
}

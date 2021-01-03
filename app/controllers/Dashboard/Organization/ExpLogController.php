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
}

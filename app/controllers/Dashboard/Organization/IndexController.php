<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Models\AssetModel;
use App\Providers\AssetProvider;
use App\Providers\UsersProvider;

class IndexController extends Controller
{
    public function dispaly(Request $request, Response $response)
    {

        $response->view('/dashboard/organization/index', []);
    }

    public function displayProfile(Request $request, Response $response)
    {
        $response->view('/dashboard/organization/profile', []);
    }


    public function displayInventory(Request $request, Response $response)
    {
        $user = $request->user();
        $orgid = $user->id();

        $items = AssetModel::select('count(*) sum, table_type')
            ->where('orgid', $orgid)
            ->groupBy('table_type')
            // ->map()
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

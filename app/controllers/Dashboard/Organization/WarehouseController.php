<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Models\WarehouseModel;

class WarehouseController extends Controller
{

    public function dispalyWarehouse(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        // $warehouse = WarehouseModel::select()
        //     ->Where('orgid', $user->id())
        //     ->fetchAll();

        // var_dump($request); die();


        $response->view('/dashboard/organization/warehouse');
    }
}
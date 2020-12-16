<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\AssetModel;
use App\Models\WarehouseModel;
use App\Providers\AssetProvider;

class WarehouseController extends Controller
{

    public function dispalyWarehouse(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $warehouse = WarehouseModel::select()
            ->Where('orgid', $user->id())
            ->fetchAll();

        $building = AssetModel::select()
            ->where('orgid', $user->id())
            ->andWhere('table_type', AssetProvider::BUILDING)
            ->andWhere('category', 'Warehouse')
            ->fetchAll();


        $response->view('/dashboard/organization/warehouse', [
            'warehouse' => $warehouse,
            'building' => $building
        ]);
    }

    public function dispalyWarepro(Request $request, Response $response)
    {
        Auth::user();
        $id = $request->id;

        $user = $request->user();
        $warehouse = WarehouseModel::select()
            ->Where('orgid', $user->id())
            ->andWhere('warehouseid', $id)
            ->map()
            ->fetchAll();

        $sum = WarehouseModel::select('sum(number) total')
            ->Where('orgid', $user->id())
            ->andWhere('warehouseid', $id)
            ->fetchOne()
            ->total;

        $current = AssetModel::select()
            ->where('orgid', $user->id())
            ->andWhere('asset', AssetProvider::CURRENT_ASSET)
            ->fetchAll();

        $building = AssetModel::findByPrimaryKey($id);

        $response->view('/dashboard/organization/warepro', [
            'building' => $building,
            'warehouse' => $warehouse,
            'current' => $current,
        ]);
    }


    public function addWarepro(Request $request, Response $response)
    {

        Auth::user();
        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $remove = $request->input('removeid');
        $warehouseid = $request->input('id');
        $productid = $request->input('productid');
        $number = $request->input('number');


        InputValidator::init();

        $number->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        if(strlen($remove) != 0){
            $number = '-' . $number;
        }

        WarehouseModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'warehouseid' => $warehouseid,
            'productid' => $productid,
            'number' => $number
        ]);



        $msg = 'You have updated successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function model()
    {
        # code...
    }
}

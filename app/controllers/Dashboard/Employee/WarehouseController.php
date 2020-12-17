<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\AssetModel;
use App\Models\WarehouseModel;
use App\Providers\AssetProvider;
use App\Providers\WarehouseProvider;

class WarehouseController extends Controller
{

    public function dispalyWarehouse(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $warehouse = WarehouseModel::select()
            ->Where('orgid', $user->userid())
            ->fetchAll();

        $building = AssetModel::select()
            ->where('orgid', $user->userid())
            ->andWhere('table_type', AssetProvider::BUILDING)
            ->andWhere('category', 'Warehouse')
            ->fetchAll();


        $response->view('/dashboard/employee/warehouse', [
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
            ->Where('orgid', $user->userid())
            ->andWhere('warehouseid', $id)
            ->map()
            ->fetchAll();

        $items = WarehouseModel::select(' productid, sum(number) total')
            ->Where('orgid', $user->userid())
            ->andWhere('warehouseid', $id)
            ->groupBy('productid')
            ->fetchAll();



        $current = AssetModel::select()
            ->where('orgid', $user->userid())
            ->andWhere('asset', AssetProvider::CURRENT_ASSET)
            ->fetchAll();

        $building = AssetModel::findByPrimaryKey($id);

        $response->view('/dashboard/employee/warepro', [
            'building' => $building,
            'warehouse' => $warehouse,
            'current' => $current,
            'num' => $items
        ]);
    }


    public function addWarepro(Request $request, Response $response)
    {

        Auth::user();
        $userid = $request->user()->id();
        $orgid = $request->user()->userid();
        $remove = $request->input('removeid');
        $warehouseid = $request->input('id');
        $productid = $request->input('productid');
        $number = $request->input('number');
        $type = WarehouseProvider::ADDED;


        InputValidator::init();

        $number->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }



        if (strlen($remove) != 0) {
            $warehouseid = $remove;
            $number = '-' . $number;
            $type = WarehouseProvider::REMOVED;
        }



        WarehouseModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'warehouseid' => $warehouseid,
            'productid' => $productid,
            'number' => $number,
            'type' => $type
        ]);



        $msg = 'You have updated successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function model()
    {
        # code...
    }
}

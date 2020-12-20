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
use App\Providers\WarehouseProvider;

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

        $items = WarehouseModel::select(['id', 'productid', 'sum(number) total'])
            ->where('orgid', $user->id())
            ->and('warehouseid', $id)
            ->groupBy('productid')
            //->map()
            ->fetchAll();


        $current = AssetModel::select()
            ->where('orgid', $user->id())
            ->andWhere('asset', AssetProvider::CURRENT_ASSET)
            ->fetchAll();

        $building = AssetModel::findByPrimaryKey($id);

        $response->view('/dashboard/organization/warepro', [
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
        $orgid = $request->user()->id();
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

        // var_dump($warehouseid); die();


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

    public function displayInputAnalysis(Request $request, Response $response)
    {
        $user = $request->user();

        $input = WarehouseModel::select('sum(number) total, created_at')
                    ->where('orgid', $user->id())
                    ->andWhere('type', '1')
                    ->groupBy('date(created_at)')
                    ->fetchAll();
        
        $datas = [];
        $dates = [];

        foreach ($input as $value) {
            $datas[] = $value->total ;
            $dates[] = date('Y-m-d', strtotime($value->created_at));
        }

        

        $response->view('/dashboard/organization/input-analysis', [
            'datas' => json_encode($datas),
            'dates' => json_encode($dates)
        ]);
    }

    public function displayOutputAnalysis(Request $request, Response $response)
    {
        $user = $request->user();

        $output = WarehouseModel::select('sum(cast(number as int)) total, created_at')
                    ->where('orgid', $user->id())
                    ->andWhere('type', '0 ')
                    ->groupBy('date(created_at)')
                    ->fetchAll();

        
        $datas = [];
        $dates = [];
        foreach ($output as $value) {
            $datas[] = $value->total * -1 ;
            $dates[] = date('Y-m-d', strtotime($value->created_at));
        }

        

        $response->view('/dashboard/organization/input-analysis', [
            'datas' => json_encode($datas),
            'dates' => json_encode($dates)
        ]);
    }
}

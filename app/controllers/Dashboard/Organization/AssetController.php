<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Models\AssetModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\AssetProvider;
use App\Core\Misc\InputValidator;

class AssetController extends Controller
{
    public function delete(Request $request, Response $response)
    {

        $id = $request->input('id');


        AssetModel::findByPrimaryKeyAndRemove($id);



        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = 'You have deleted successfully';
        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }



     // Building
     public function displayBuilding(Request $request, Response $response)
     {
         Auth::user();
         $user = $request->user();
         $buildings = AssetModel::select()
             ->where('table_type', AssetProvider::BUILDING)
             ->andWhere('orgid', $user->id())
             ->map()
             ->fetchAll();
 
 
         $response->view('/dashboard/organization/building', [
             'buildings' => $buildings
         ]);
     }
 
     public function addBuilding(Request $request, Response $response)
     {
 
         $userid = $request->user()->id();
         $orgid = $request->user()->id();
         $table_type = AssetProvider::BUILDING;
         $name = $request->input('name');
         $description = $request->input('description');
         $size = $request->input('size');
         $amount = $request->input('amount');
         $location = $request->input('location');
         $category = $request->input('category');
         $asset = AssetProvider::FIXED_ASSET;
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $size->validate('required');
         $amount->validate('required');
         $location->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::createEntry([
             'userid' => $userid,
             'orgid' => $orgid,
             'table_type' => $table_type,
             'name' => $name,
             'description' => $description,
             'size' => $size,
             'amount' => $amount,
             'location' => $location,
             'category' => $category,
             'asset' => $asset
         ]);
 
         $msg = 'You have updated successfully';
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
     }
 
     public function updateBuilding(Request $request, Response $response)
     {
         $id = $request->url()->getQuery('id');
         $name = $request->input('name');
         $description = $request->input('description');
         $size = $request->input('size');
         $amount = $request->input('amount');
         $location = $request->input('location');
         $category = $request->input('category');
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $size->validate('required');
         $amount->validate('required');
         $location->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::findByPrimaryKeyAndUpdate(
             $id,
             [
                 'name' => $name,
                 'description' => $description,
                 'size' => $size,
                 'amount' => $amount,
                 'location' => $location,
                 'category' => $category,
             ]
         );
 
         
         $msg = 'You have updated successfully';
 
         $url = explode('/', $request->url()->getPath());
         array_pop($url);
         $url = implode('/', $url);
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
     }
 
 
 
     // Machinery
 
     public function displayMachinery(Request $request, Response $response)
     {
         Auth::user();
         $user = $request->user();
         $machinery = AssetModel::select()
             ->where('table_type', AssetProvider::MACHINERY)
             ->andWhere('orgid', $user->id())
             ->map()
             ->fetchAll();
 
 
         $response->view('/dashboard/organization/machinery', [
             'machinery' => $machinery
         ]);
     }
 
     public function addMachinery(Request $request, Response $response)
     {
 
         $userid = $request->user()->id();
         $orgid = $request->user()->id();
         $table_type = AssetProvider::MACHINERY;
         $name = $request->input('name');
         $description = $request->input('description');
         $manufacturer = $request->input('manufacturer');
         $amount = $request->input('amount');
         $serial_no = $request->input('serial_no');
         $category = $request->input('category');
         $asset = AssetProvider::FIXED_ASSET;
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $manufacturer->validate('required');
         $amount->validate('required');
         $serial_no->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::createEntry([
             'userid' => $userid,
             'orgid' => $orgid,
             'table_type' => $table_type,
             'name' => $name,
             'description' => $description,
             'Manufacturer' => $manufacturer,
             'amount' => $amount,
             'serial_no' => $serial_no,
             'category' => $category,
             'asset' => $asset
         ]);
 
         $msg = 'You have updated successfully';
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
     }
 
     public function updateMachinery(Request $request, Response $response)
     {
         $id = $request->url()->getQuery('id');
         $name = $request->input('name');
         $description = $request->input('description');
         $manufacturer = $request->input('manufacturer');
         $amount = $request->input('amount');
         $serial_no = $request->input('serial_no');
         $category = $request->input('category');
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $manufacturer->validate('required');
         $amount->validate('required');
         $serial_no->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::findByPrimaryKeyAndUpdate(
             $id,
             [
                 'name' => $name,
                 'description' => $description,
                 'manufacturer' => $manufacturer,
                 'amount' => $amount,
                 'serial_no' => $serial_no,
                 'category' => $category,
             ]
         );
 
         
 
 
         $url = explode('/', $request->url()->getPath());
         array_pop($url);
         $url = implode('/', $url);
 
         $msg = 'You have updated successfully';
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
     }
 
 
 
 
 
 
 
 
     // Vehicle
 
 
     public function displayVehicle(Request $request, Response $response)
     {
         Auth::user();
         $user = $request->user();
         $vehicle = AssetModel::select()
             ->where('table_type', AssetProvider::VEHICLE)
             ->andWhere('orgid', $user->id())
             ->map()
             ->fetchAll();
 
 
         $response->view('/dashboard/organization/vehicle', [
             'vehicle' => $vehicle
         ]);
     }
 
     public function addVehicle(Request $request, Response $response)
     {
 
         $userid = $request->user()->id();
         $orgid = $request->user()->id();
         $table_type = AssetProvider::VEHICLE;
         $name = $request->input('name');
         $description = $request->input('description');
         $manufacturer = $request->input('manufacturer');
         $amount = $request->input('amount');
         $serial_no = $request->input('serial_no');
         $category = $request->input('category');
         $asset = AssetProvider::FIXED_ASSET;
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $manufacturer->validate('required');
         $amount->validate('required');
         $serial_no->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::createEntry([
             'userid' => $userid,
             'orgid' => $orgid,
             'table_type' => $table_type,
             'name' => $name,
             'description' => $description,
             'Manufacturer' => $manufacturer,
             'amount' => $amount,
             'serial_no' => $serial_no,
             'category' => $category,
             'asset' => $asset
         ]);
 
         $msg = 'You have updated successfully';
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
     }
 
     public function updateVehicle(Request $request, Response $response)
     {
         $id = $request->url()->getQuery('id');
         $name = $request->input('name');
         $description = $request->input('description');
         $manufacturer = $request->input('manufacturer');
         $amount = $request->input('amount');
         $serial_no = $request->input('serial_no');
         $category = $request->input('category');
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $manufacturer->validate('required');
         $amount->validate('required');
         $serial_no->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::findByPrimaryKeyAndUpdate(
             $id,
             [
                 'name' => $name,
                 'description' => $description,
                 'manufacturer' => $manufacturer,
                 'amount' => $amount,
                 'serial_no' => $serial_no,
                 'category' => $category,
             ]
         );
 
         
 
 
         $url = explode('/', $request->url()->getPath());
         array_pop($url);
         $url = implode('/', $url);
 
         $msg = 'You have updated successfully';
         return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
     }
 
 
 
 
 
 
 
 
 
     // Land
 
 
     public function displayLand(Request $request, Response $response)
     {
         Auth::user();
         $user = $request->user();
         $land = AssetModel::select()
             ->where('table_type', AssetProvider::LAND)
             ->andWhere('orgid', $user->id())
             ->map()
             ->fetchAll();
 
 
         $response->view('/dashboard/organization/land', [
             'land' => $land
         ]);
     }
 
     public function addLand(Request $request, Response $response)
     {
 
         $userid = $request->user()->id();
         $orgid = $request->user()->id();
         $table_type = AssetProvider::LAND;
         $name = $request->input('name');
         $description = $request->input('description');
         $size = $request->input('size');
         $amount = $request->input('amount');
         $location = $request->input('location');
         $category = $request->input('category');
         $asset = AssetProvider::FIXED_ASSET;
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $size->validate('required');
         $amount->validate('required');
         $location->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::createEntry([
             'userid' => $userid,
             'orgid' => $orgid,
             'table_type' => $table_type,
             'name' => $name,
             'description' => $description,
             'size' => $size,
             'amount' => $amount,
             'location' => $location,
             'category' => $category,
             'asset' => $asset
         ]);
 
         $msg = 'You have updated successfully';
 
         return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
     }
 
     public function updateLand(Request $request, Response $response)
     {
         $id = $request->url()->getQuery('id');
         $name = $request->input('name');
         $description = $request->input('description');
         $size = $request->input('size');
         $amount = $request->input('amount');
         $location = $request->input('location');
         $category = $request->input('category');
 
 
         InputValidator::init();
 
         $name->validate('required');
         $description->validate('required');
         $size->validate('required');
         $amount->validate('required');
         $location->validate('required');
         $category->validate('required');
 
         if (!InputValidator::isValid()) {
             $errors = InputValidator::getErrors();
             
             return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
         }
 
         AssetModel::findByPrimaryKeyAndUpdate(
             $id,
             [
                 'name' => $name,
                 'description' => $description,
                 'size' => $size,
                 'amount' => $amount,
                 'location' => $location,
                 'category' => $category,
             ]
         );
 
         
 
 
         $url = explode('/', $request->url()->getPath());
         array_pop($url);
         $url = implode('/', $url);
         $msg = 'You have updated successfully';
         return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
     }



    // OtherAsset
    public function displayOtherAsset(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $other_asset = AssetModel::select()
            ->where('table_type', AssetProvider::OTHER_ASSET)
            ->andWhere('orgid', $user->id())
            ->map()
            ->fetchAll();

        $response->view('/dashboard/organization/otherAsset', [
            'other_asset' => $other_asset
        ]);
    }




    public function addOtherAsset(Request $request, Response $response)
    {

        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $table_type = AssetProvider::OTHER_ASSET;
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $location = $request->input('location');
        $asset = AssetProvider::CURRENT_ASSET;


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $location->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }


        AssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'table_type' => $table_type,
            'name' => $name,
            'description' => $description,
            'manufacturer' => $manufacturer,
            'amount' => $amount,
            'location' => $location,
            'asset' => $asset
        ]);

        $msg = 'You have successfully added a new information';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }





    public function updateOtherAsset(Request $request, Response $response)
    {
        $id = $request->url()->getQuery('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $location = $request->input('location');


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $location->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'manufacturer' => $manufacturer,
                'amount' => $amount,
                'location' => $location,
            ]
        );




        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = 'You have updated successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }



    // Equipment

    public function displayEquipment(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $equipment = AssetModel::select()
            ->where('table_type', AssetProvider::EQUIPMENT)
            ->andWhere('orgid', $user->id())
            ->fetchAll();


        $response->view('/dashboard/organization/equipment', [
            'equipment' => $equipment
        ]);
    }

    public function addEquipment(Request $request, Response $response)
    {

        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $table_type = AssetProvider::EQUIPMENT;
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $location = $request->input('location');
        $category = $request->input('category');
        $asset = AssetProvider::CURRENT_ASSET;


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $location->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'table_type' => $table_type,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
            'amount' => $amount,
            'location' => $location,
            'category' => $category,
            'asset' => $asset
        ]);

        $msg = 'You have added successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }



    public function updateEquipment(Request $request, Response $response)
    {
        $id = $request->url()->getQuery('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $location = $request->input('location');
        $category = $request->input('category');


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $location->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'Manufacturer' => $manufacturer,
                'amount' => $amount,
                'location' => $location,
                'category' => $category,
            ]
        );




        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = 'You have updated successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }








    // Goods


    public function displayGoods(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $goods = AssetModel::select()
            ->where('table_type', AssetProvider::GOODS)
            ->andWhere('orgid', $user->id())
            ->fetchAll();


        $response->view('/dashboard/organization/goods', [
            'goods' => $goods
        ]);
    }




    public function addGoods(Request $request, Response $response)
    {

        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $table_type = AssetProvider::GOODS;
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $category = $request->input('category');
        $asset = AssetProvider::CURRENT_ASSET;


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'table_type' => $table_type,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
            'amount' => $amount,
            'category' => $category,
            'asset' => $asset
        ]);

        $msg = 'You have added successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }



    public function updateGoods(Request $request, Response $response)
    {
        $id = $request->url()->getQuery('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $manufacturer = $request->input('manufacturer');
        $amount = $request->input('amount');
        $category = $request->input('category');


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $manufacturer->validate('required');
        $amount->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'manufacturer' => $manufacturer,
                'amount' => $amount,
                'category' => $category,
            ]
        );




        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = 'You have updated successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }









    // Product


    public function displayProduct(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $product = AssetModel::select()
            ->where('table_type', AssetProvider::PRODUCT)
            ->andWhere('orgid', $user->id())
            ->fetchAll();


        $response->view('/dashboard/organization/product', [
            'product' => $product
        ]);
    }

    public function addProduct(Request $request, Response $response)
    {

        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $table_type = AssetProvider::PRODUCT;
        $name = $request->input('name');
        $description = $request->input('description');
        $size = $request->input('size');
        $amount = $request->input('amount');
        $location = $request->input('location');
        $category = $request->input('category');
        $asset = AssetProvider::CURRENT_ASSET;


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $size->validate('required');
        $amount->validate('required');
        $location->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'table_type' => $table_type,
            'name' => $name,
            'description' => $description,
            'size' => $size,
            'amount' => $amount,
            'location' => $location,
            'category' => $category,
            'asset' => $asset
        ]);

        $msg = 'You have added successfully';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function updateProduct(Request $request, Response $response)
    {
        $id = $request->url()->getQuery('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $size = $request->input('size');
        $amount = $request->input('amount');
        $location = $request->input('location');
        $category = $request->input('category');


        InputValidator::init();

        $name->validate('required');
        $description->validate('required');
        $size->validate('required');
        $amount->validate('required');
        $location->validate('required');
        $category->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        AssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'size' => $size,
                'amount' => $amount,
                'location' => $location,
                'category' => $category,
            ]
        );


        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = 'You have updated successfully';
        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }
}
<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Models\FixedAssetModel;
use App\Core\Misc\InputValidator;
use App\Providers\FixedAssetProvider;

class FixedAssetController extends Controller
{


    public function delete(Request $request, Response $response)
    {

        $id = $request->input('id');


        FixedAssetModel::findByPrimaryKeyAndRemove($id);

        $msg = 'You have deleted successfully';

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);


        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    // Building
    public function displayBuilding(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $buildings = FixedAssetModel::select()
            ->where('del', FixedAssetProvider::BUILDING)
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
        $del = FixedAssetProvider::BUILDING;
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

        FixedAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'size' => $size,
            'amount' => $amount,
            'location' => $location,
            'category' => $category,
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

        FixedAssetModel::findByPrimaryKeyAndUpdate(
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
        $machinery = FixedAssetModel::select()
            ->where('del', FixedAssetProvider::MACHINERY)
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
        $del = FixedAssetProvider::MACHINERY;
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

        FixedAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
            'amount' => $amount,
            'serial_no' => $serial_no,
            'category' => $category,
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

        FixedAssetModel::findByPrimaryKeyAndUpdate(
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
        $vehicle = FixedAssetModel::select()
            ->where('del', FixedAssetProvider::VEHICLE)
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
        $del = FixedAssetProvider::VEHICLE;
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

        FixedAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
            'amount' => $amount,
            'serial_no' => $serial_no,
            'category' => $category,
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

        FixedAssetModel::findByPrimaryKeyAndUpdate(
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
        $land = FixedAssetModel::select()
            ->where('del', FixedAssetProvider::LAND)
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
        $del = FixedAssetProvider::LAND;
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

        FixedAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'size' => $size,
            'amount' => $amount,
            'location' => $location,
            'category' => $category,
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

        FixedAssetModel::findByPrimaryKeyAndUpdate(
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

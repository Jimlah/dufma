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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Deleted
            </div>';

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully updated the database
            </div>';


        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
    }



    // Machinery

    public function displayMachinery(Request $request, Response $response)
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

    public function addMachinery(Request $request, Response $response)
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
    }

    public function updateMachinery(Request $request, Response $response)
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully updated the database
            </div>';


        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
    }








    // Vehicle


    public function displayVehicle(Request $request, Response $response)
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

    public function addVehicle(Request $request, Response $response)
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
    }

    public function updateVehicle(Request $request, Response $response)
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully updated the database
            </div>';


        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
    }









    // Land


    public function displayLand(Request $request, Response $response)
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

    public function addLand(Request $request, Response $response)
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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
            $msg = '';
            foreach ($errors as $key) {
                $msg .= '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ' .   $key[0] . '
            </div>';
            }
            return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully updated the database
            </div>';


        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        return $response->withSession('msg', $msg)->redirect($url);
    }
}

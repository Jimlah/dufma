<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Tools\Auth;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Migrations\CurrentAsset;
use App\Models\CurrentAssetModel;
use App\Providers\CurrentAssetProvider;

class CurrentAssetController extends Controller
{
    public function delete(Request $request, Response $response)
    {

        $id = $request->input('id');


        CurrentAssetModel::findByPrimaryKeyAndRemove($id);

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

    // OtherAsset
    public function displayOtherAsset(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $otasset = CurrentAssetModel::select()
            ->where('del', CurrentAssetProvider::OTASSET)
            ->andWhere('orgid', $user->id())
            ->fetchAll();


        $response->view('/dashboard/organization/otherAsset', [
            'otasset' => $otasset
        ]);
    }

    public function addOtherAsset(Request $request, Response $response)
    {

        $userid = $request->user()->id();
        $orgid = $request->user()->id();
        $del = CurrentAssetProvider::OTASSET;
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

        CurrentAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'manufacturer' => $manufacturer,
            'amount' => $amount,
            'location' => $location,
        ]);

        $msg = '<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                You have successfully Registered
            </div>';

        return $response->withSession('msg', $msg)->redirect($request->url()->getPath());
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

        CurrentAssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'manufacturer' => $manufacturer,
                'amount' => $amount,
                'location' => $location,
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



    // Equipment

    public function displayEquipment(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $equipment = CurrentAssetModel::select()
            ->where('del', CurrentAssetProvider::EQUIPMENT)
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
        $del = CurrentAssetProvider::EQUIPMENT;
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

        CurrentAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
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

        CurrentAssetModel::findByPrimaryKeyAndUpdate($id,
            [
                'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
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








    // Goods


    public function displayGoods(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $goods = CurrentAssetModel::select()
            ->where('del', CurrentAssetProvider::GOODS)
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
        $del = CurrentAssetProvider::GOODS;
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

        CurrentAssetModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'del' => $del,
            'name' => $name,
            'description' => $description,
            'Manufacturer' => $manufacturer,
            'amount' => $amount,
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

        CurrentAssetModel::findByPrimaryKeyAndUpdate(
            $id,
            [
                'name' => $name,
                'description' => $description,
                'manufacturer' => $manufacturer,
                'amount' => $amount,
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









    // Product


    public function displayProduct(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $product = CurrentAssetModel::select()
            ->where('del', CurrentAssetProvider::PRODUCT)
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
        $del = CurrentAssetProvider::PRODUCT;
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

        CurrentAssetModel::createEntry([
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

        CurrentAssetModel::findByPrimaryKeyAndUpdate(
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

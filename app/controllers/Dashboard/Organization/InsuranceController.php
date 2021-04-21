<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Migrations\Insurance;
use App\Models\InsuranceModel;
use App\Providers\InsuranceProvider;

class InsuranceController extends Controller
{
    public function index(Request $request, Response $response)
    {   
        $user = $request->user();
        $insurance = InsuranceModel::findAllBy('orgid', $user->id());

        return $response->view('dashboard.admin.insurance', [
            'insurance' => $insurance
        ]);
    }

    public function product(Request $request, Response $response)
    {
        $user = $request->user();
        $insurance = InsuranceModel::select()
                                    ->where('orgid', $user->id())
                                    ->and('category', InsuranceProvider::PRODUCT_CATEGORY)
                                    ->fetchAll();

        return $response->view('dashboard.admin.insurance', [
            'insurance' => $insurance
        ]);
    }

    public function service(Request $request, Response $response)
    {
        $user = $request->user();
        $insurance = InsuranceModel::select()
                                    ->where('orgid', $user->id())
                                    ->and('category', InsuranceProvider::SERVICE_CATEGORY)
                                    ->fetchAll();

        return $response->view('dashboard.admin.insurance', [
            'insurance' => $insurance
        ]);
    }
}
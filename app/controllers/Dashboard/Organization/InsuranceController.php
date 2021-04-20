<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Migrations\Insurance;
use App\Models\InsuranceModel;

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
}
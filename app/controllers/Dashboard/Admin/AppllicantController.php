<?php

namespace App\Controllers\Dashboard\Admin;

use App\Models\DemoModel;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\DemoProvider;

class AppllicantController extends Controller
{
    public function erp(Request $request, Response $response)
    {   
        $appllicants =  DemoModel::findAllBy('demo_type', DemoProvider::ERP);

        $response->view('/dashboard/admin/applicant',[
            'appllicants' => $appllicants
        ]);

    }

    public function smartFarming(Request $request, Response $response)
    {   
        $appllicants =  DemoModel::findAllBy('demo_type', DemoProvider::SMART_FARMING);

        $response->view('/dashboard/admin/applicant',[
            'appllicants' => $appllicants
        ]);

    }
}
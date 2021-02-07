<?php

namespace App\Controllers\Dashboard\Admin;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\PriceModel;
use App\Providers\PriceProvider;

class PriceController extends Controller
{
    public function price(Request $request, Response $response)
    {
        $response->view('/dashboard/admin/pricing-list', [
            "features" => PriceProvider::FEATURES 
        ]);
    }

    public function priceAction(Request $request, Response $response)
    {
        list(
            $name,
            $summary,
            $description,
            $employee_num,
            $features,
            $amount) = $request->input('name, summary, description, employee_num, features, amount');
    
        InputValidator::init();

        $name->validate('required');
        $summary->validate('required');
        $description->validate('required');
        $employee_num->validate('required');
        $features->validate('required');
        $amount->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        PriceModel::createEntry([
            'name' => $name,
            'summary' => $summary,
            'description' => $description,
            'employee_num' => $employee_num,
            'features' => $features,
            'amount' => $amount,
        ]);

        $msg = 'You have successfully added a new Pricing';
        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }
}

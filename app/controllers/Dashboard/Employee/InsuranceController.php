<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\InsuranceModel;
use App\Providers\InsuranceProvider;

class InsuranceController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $user = $request->user();
        $insurance = InsuranceModel::findAllBy('orgid', $user->id());

        return $response->view('dashboard.employee.insurance', [
            'insurance' => $insurance
        ]);
    }

    public function create(Request $request, Response $response)
    {
        $category = [
            InsuranceProvider::PRODUCT_CATEGORY => 'Product',
            InsuranceProvider::SERVICE_CATEGORY => 'Service'
        ];
        return $response->view('dashboard.employee.insurance-edit', [
            'category' => $category
        ]);
    }

    public function store(Request $request, Response $response)
    {
        $user = $request->user();
        list(
            $name,
            $insurance_parameter,
            $quantity,
            $content,
            $start_date,
            $end_date,
            $expected_number_inspection,
            $insurance_cost,
            $insurance_terms,
            $category,
            $officer_name,
            $company_name,
            $purpose,
            $total_cost,
            $application_date,
            $inspection_date,
            $insurance_approval_date,
            $insurance_state,
            $insurance_branch,
            $insurance_relationship_officer,
            $duration
        ) = $request->input('name, insurance_parameter, quantity, content, start_date, end_date, expected_number_inspection, insurance_cost, insurance_terms, category, officer_name, company_name, purpose, total_cost, application_date, inspection_date, insurance_approval_date, insurance_state, insurance_branch, insurance_relationship_officer, duration');

        InputValidator::init([]);

        $name->validate('required');

        if (!Inputvalidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        InsuranceModel::createEntry([
            'userid' => $user->id(),
            'orgid' => $user->userid(),
            'name' => $name,
            'insurance_parameter' => $insurance_parameter,
            "quantity" => $quantity,
            "content" => $content,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "expected_number_inspection" => $expected_number_inspection,
            "insurance_cost" => $insurance_cost,
            "insurance_terms" => $insurance_terms,
            "category" => $category,
            "officer_name" => $officer_name,
            "company_name" => $company_name,
            "purpose" => $purpose,
            "total_cost" => $total_cost,
            "application_date" => $application_date,
            "inspection_date" => $inspection_date,
            "insurance_approval_date" => $insurance_approval_date,
            "insurance_state" => $insurance_state,
            "insurance_branch" => $insurance_branch,
            "insurance_relationship_officer" => $insurance_relationship_officer,
            "duration" => $duration
        ]);

        $msg = "Insurance uploaded successfully";
        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function edit(Request $request, Response $response)
    {
        $id = $request->id;
        $insurance = InsuranceModel::findByPrimaryKey($id);
        $category = [
            InsuranceProvider::PRODUCT_CATEGORY => 'Product',
            InsuranceProvider::SERVICE_CATEGORY => 'Service'
        ];
        return $response->view('dashboard.employee.insurance-edit', [
            "insurance" => $insurance,
            "category" => $category
        ]);
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->id;
        list(
            $name,
            $insurance_parameter,
            $quantity,
            $content,
            $start_date,
            $end_date,
            $expected_number_inspection,
            $insurance_cost,
            $insurance_terms,
            $category,
            $officer_name,
            $company_name,
            $purpose,
            $total_cost,
            $application_date,
            $inspection_date,
            $insurance_approval_date,
            $insurance_state,
            $insurance_branch,
            $insurance_relationship_officer,
            $duration
        ) = $request->input('name, insurance_parameter, quantity, content, start_date, end_date, expected_number_inspection, insurance_cost, insurance_terms, category, officer_name, company_name, purpose, total_cost, application_date, inspection_date, insurance_approval_date, insurance_state, insurance_branch, insurance_relationship_officer, duration');

        InputValidator::init([]);

        $name->validate('required');

        if (!Inputvalidator::isValid()) {
            $errors = InputValidator::getListedErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        InsuranceModel::findByPrimaryKeyAndUpdate($id, [
            'name' => $name,
            'insurance_parameter' => $insurance_parameter,
            "quantity" => $quantity,
            "content" => $content,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "expected_number_inspection" => $expected_number_inspection,
            "insurance_cost" => $insurance_cost,
            "insurance_terms" => $insurance_terms,
            "category" => $category,
            "officer_name" => $officer_name,
            "company_name" => $company_name,
            "purpose" => $purpose,
            "total_cost" => $total_cost,
            "application_date" => $application_date,
            "inspection_date" => $inspection_date,
            "insurance_approval_date" => $insurance_approval_date,
            "insurance_state" => $insurance_state,
            "insurance_branch" => $insurance_branch,
            "insurance_relationship_officer" => $insurance_relationship_officer,
            "duration" => $duration
        ]);

        $msg = "Insurance uploaded successfully";
        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }

    public function destroy(Request $request, Response $response)
    {
        $id = $request->id();
        InsuranceModel::findByPrimaryKeyAndRemove($id);

        return $response->redirect('dashboard/employee/insurance');
    }
}

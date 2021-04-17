<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\PestdiseaseModel;

class DiseaseController extends Controller
{
    // public function index(Request $request, Response $response)
    // {   
    //     $disease = PestdiseaseModel::findBy('disease', 'category');
    //     return $response->view("dashboard.organization.disease_gloassary", [
    //         "disease" => $disease
    //     ]);
    // }

    // public function store(Request $request, Response $response)
    // {
    //     $user = $request->user();
    //     list(
    //         $user->id,
    //         $user->userid,
    //         $name,
    //         $sci_name,
    //         $category,
    //         $disease,
    //         $symptoms,
    //         $cause,
    //         $host,
    //         $life_cycle,
    //         $treatement
    //     ) = $request->input('userid, orgid, name, sci_name, category ,disease ,symptoms, cause, host, life_cycle,treatment',);

    //     InputValidator::init([]);

    //     $name->validate("required");
    //     $sci_name->validate("required");
    //     $category->validate("required");
    //     $disease->validate("required");
    //     $symptoms->validate("required");
    //     $cause->validate("required");
    //     $host->validate("required");
    //     $life_cycle->validate("required");
    //     $treatement->validate("required");

    //     if(!InputValidator::isValid()){
    //         $errors = InputValidator::getErrors();
    //         return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
    //     }

    //     PestdiseaseModel::createEntry([
    //         'userid' => $user->id,
    //         'orgid' => $user->userid,
    //         "name" => $name,
    //         "sci_name" => $sci_name,
    //         "category" => $category,
    //         "disease" =>$disease,
    //         "symptoms" => $symptoms,
    //         "cause" => $cause,
    //         "host" => $host,
    //         "life_cycle" => $life_cycle,
    //         "treatment" =>  $treatement
    //     ]);

    //     $message = "You have successfully updated the disease Database";
    //     return $response->withSession('msg', [$message, 'error'])->redirect('/dashboard/organization/disease');
    // }
}
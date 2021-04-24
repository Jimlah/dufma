<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\FarmpestdiseaseModel;
use App\Providers\FarmpestdiseaseProvider;

class DiseaseController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function index(Request $request, Response $response)
    {
        $diseases = FarmpestdiseaseModel::findAllBy('type', FarmpestdiseaseProvider::DISEASE);
        return $response->view("dashboard.organization.diseases", [
            "diseases" => $diseases
        ]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function store(Request $request, Response $response)
    {
        $user = $request->user();
        list(
            $date_detected,
            $time_detected,
            $name,
            $sci_name,
            $description,
            $detected_by,
            $steps,
            $week1,
            $week2,
            $week3,
            $remark
        ) = $request->input('date_detected, time_detected, name, sci_name, description, detected_by, steps, week1, week2, week3, remark');

        InputValidator::init([]);

        $date_detected->validate("required");
        $time_detected->validate("required");
        $name->validate("required");
        $sci_name->validate("required");
        $description->validate("required");
        $detected_by->validate("required");
        $steps->validate("required");
        $week1->validate("required");
        $week2->validate("required");
        $week3->validate("required");
        $remark->validate("required");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        FarmpestdiseaseModel::createEntry([
            'userid' => $user->id(),
            'orgid' => $user->id(),
            "date_detected" => $date_detected,
            "time_detected" => $time_detected,
            "name" => $name,
            "sci_name" => $sci_name,
            "description" => $description,
            "detected_by" => $detected_by,
            "steps" => $steps,
            "week1" => $week1,
            "week2" => $week2,
            "week3" => $week3,
            "remark" =>  $remark,
            "type" => FarmpestdiseaseProvider::DISEASE
        ]);

        $message = "You have successfully added to the diseases Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/diseases');
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function update(Request $request, Response $response)
    {
        $id = $request->id;
        $user = $request->user();
        list(
            $date_detected,
            $time_detected,
            $name,
            $sci_name,
            $description,
            $detected_by,
            $steps,
            $week1,
            $week2,
            $week3,
            $remark
        ) = $request->input('date_detected, time_detected, name, sci_name, description, detected_by, steps, week1, week2, week3, remark');

        InputValidator::init([]);

        $date_detected->validate("required");
        $time_detected->validate("required");
        $name->validate("required");
        $sci_name->validate("required");
        $description->validate("required");
        $detected_by->validate("required");
        $steps->validate("required");
        $week1->validate("required");
        $week2->validate("required");
        $week3->validate("required");
        $remark->validate("required");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        FarmpestdiseaseModel::findByPrimaryKeyAndUpdate($id, [
            'userid' => $user->id(),
            "name" => $name,
            "sci_name" => $sci_name,
            "detected_by" => $detected_by,
            "steps" => $steps,
            "week1" => $week1,
            "week2" => $week2,
            "week3" => $week3,
            "remark" =>  $remark,
            "type" => FarmpestdiseaseProvider::DISEASE
        ]);

        $message = "You have successfully updated the Diseases Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/diseases');
    }

    public function destroy(Request $request, Response $response)
    {
        $id = $request->input("id");

        FarmpestdiseaseModel::findByPrimaryKeyAndRemove($id);
        $message = "You have successfully deleted from the Diseases Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/diseases');
    }
}
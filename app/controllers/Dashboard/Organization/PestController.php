<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\FarmpestdiseaseModel;
use App\Providers\FarmpestdiseaseProvider;

class PestController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $pests = FarmpestdiseaseModel::findAllBy('type', FarmpestdiseaseProvider::PEST);
        return $response->view("dashboard.organization.pests", [
            "pests" => $pests
        ]);
    }

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
            'orgid' => $user->userid(),
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
            "type" => FarmpestdiseaseProvider::PEST
        ]);

        $message = "You have successfully added to the pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests');
    }

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
            "type" => FarmpestdiseaseProvider::PEST
        ]);

        $message = "You have successfully updated the Pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests');
    }

    public function destroy(Request $request, Response $response)
    {
        $id = $request->input("id");

        FarmpestdiseaseModel::findByPrimaryKeyAndRemove($id);
        $message = "You have successfully deleted from the Pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests');
    }
}
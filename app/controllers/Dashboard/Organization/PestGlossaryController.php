<?php

namespace App\Controllers\Dashboard\Organization;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Models\PestdiseaseModel;
use App\Core\Misc\InputValidator;
use App\Providers\PestdiseaseProvider;

class PestGlossaryController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $pests = PestdiseaseModel::findAllBy('type', PestdiseaseProvider::PEST);
        return $response->view("dashboard.organization.pest_glossary", [
            "pests" => $pests
        ]);
    }

    public function store(Request $request, Response $response)
    {
        $user = $request->user();
        list(
            $name,
            $sci_name,
            $category,
            $disease,
            $symptoms,
            $cause,
            $host,
            $life_cycle,
            $treatement
        ) = $request->input('name, sci_name, category ,disease_type ,symptoms, cause, host, life_cycle, treatment');

        InputValidator::init([]);

        $name->validate("required");
        $sci_name->validate("required");
        $category->validate("required");
        $disease->validate("required");
        $symptoms->validate("required");
        $cause->validate("required");
        $host->validate("required");
        $life_cycle->validate("required");
        $treatement->validate("required");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        PestdiseaseModel::createEntry([
            'userid' => $user->id(),
            'orgid' => $user->userid(),
            "name" => $name,
            "sci_name" => $sci_name,
            "category" => $category,
            "disease_type" => $disease,
            "symptoms" => $symptoms,
            "cause" => $cause,
            "host" => $host,
            "life_cycle" => $life_cycle,
            "treatment" =>  $treatement,
            "type" => PestdiseaseProvider::PEST
        ]);

        $message = "You have successfully added to the pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests-glossary');
    }

    public function update(Request $request, Response $response)
    {
        $id = $request->id;
        $user = $request->user();
        list(
            $name,
            $sci_name,
            $category,
            $disease,
            $symptoms,
            $cause,
            $host,
            $life_cycle,
            $treatement
        ) = $request->input('name, sci_name, category ,disease_type ,symptoms, cause, host, life_cycle,treatment');

        InputValidator::init([]);

        $name->validate("required");
        $sci_name->validate("required");
        $category->validate("required");
        $disease->validate("required");
        $symptoms->validate("required");
        $cause->validate("required");
        $host->validate("required");
        $life_cycle->validate("required");
        $treatement->validate("required");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();
            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        PestdiseaseModel::findByPrimaryKeyAndUpdate($id, [
            'userid' => $user->id(),
            "name" => $name,
            "sci_name" => $sci_name,
            "category" => $category,
            "disease_type" => $disease,
            "symptoms" => $symptoms,
            "cause" => $cause,
            "host" => $host,
            "life_cycle" => $life_cycle,
            "treatment" =>  $treatement,
            "type" => PestdiseaseProvider::PEST
        ]);

        $message = "You have successfully updated the Pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests-glossary');
    }

    public function destroy(Request $request, Response $response)
    {
        $id = $request->input("id");

        PestdiseaseModel::findByPrimaryKeyAndRemove($id);
        $message = "You have successfully deleted from the Pests Database";
        return $response->withSession('msg', [$message, 'alert'])->redirect('/dashboard/organization/pests-glossary');
    }
}

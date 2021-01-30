<?php

namespace App\Controllers;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Core\Misc\InputValidator;
use App\Models\DemoModel;
use App\Models\SubscribersModel;
use App\Providers\DemoProvider;
use App\Providers\SubscribersProvider;

class CubeController extends Controller
{
    /**
     * Home controller
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function home(Request $request, Response $response)
    {
        return $response->view('home');
    }

    public function homeAction(Request $request, Response $response)
    {
        list(
            $email,
            $phone,
            $business_type,
            $message) = $request->input('email, phone, business_type, message');


            InputValidator::init([
                "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                    if ($validator->getValue() == '') {
                        return null;
                        // die();
                    }
                    if (DemoModel::findby($field, $validator->getValue())) {
    
                        $validator->attachError($message);
                    }
                }
    
            ]);
    
            $email->validate('required')->uniqueField('email', 'Email has already been registered');
            $phone->validate('required');
            $business_type->validate('required');
            $message->validate('required');
    
            if (!InputValidator::isValid()) {
                $errors = InputValidator::getErrors();
    
                return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
            }


            DemoModel::createEntry([
                'email' => $email,
                'phone' => $phone,
                'business_type' => $business_type,
                'message' => $message,
                'demo_type' => DemoProvider::ERP,
            ]);

            $msg = 'You have successfully booked a demo with us we will get back to you soon';

            return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());

    }

    public function subscribe(Request $request, Response $response)
    {
        $email = $request->input('email');

        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                }
                if (SubscribersModel::findby($field, $validator->getValue())) {

                    $validator->attachError($message);
                }
            }

        ]);

        $email->validate('required')->uniqueField('email', 'Email has already been registered');
        

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getListedErrors();

            return $response->withSession('msg', $errors)->redirect($request->url()->getPath());
        }

        SubscribersModel::createEntry([
            'email' => $email,
            'status' => SubscribersProvider::SUBSCRIBE
        ]);

        $msg = "You have successfully subscribe to our newsletter";
        return $response->withSession('msg', $msg)->redirect('/');
    }

    public function _404(Request $request, Response $response)
    {
        return $response->view('404');
    }
}
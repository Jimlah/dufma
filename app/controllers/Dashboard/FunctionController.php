<?php

namespace App\Controllers\Dashboard;

use Exception;
use Swift_Mailer;
use Swift_Message;
use App\Core\Tools\Auth;
use Swift_SmtpTransport;
use App\Core\Http\Request;
use App\Models\UsersModel;
use App\Core\Http\Response;
use App\Core\Http\Controller;
use App\Providers\UsersProvider;
use App\Core\Misc\InputValidator;
use App\Models\TransactionModel;
use App\Providers\TransactionProvider;

class FunctionController extends Controller
{
    public function logout(Request $request, Response $response)
    {
        Auth::logout();
        return $response->redirect('/');
    }



    public function registerEmp(Request $request, Response $response)
    {
        $user = $request->user();
        $username = $request->input('username');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password1 = $request->input('password1');
        $access = UsersProvider::ACCESS_EMPLOYEE;
        $status = UsersProvider::STATUS_ACTIVE;
        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                    // die();
                }
                if (UsersModel::findby($field, $validator->getValue())) {

                    $validator->attachError($message);
                }
            }

        ]);

        $username->validate('required')->uniqueField('username', 'Username has already been registered');
        $lastname->validate('required');
        $firstname->validate('required');
        $email->validate('required')->uniqueField('email', 'Email has already been registered');
        $password->validate('required')->equals($password1, "Password does not match");

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        UsersModel::createEntry([
            'userid' => $user->id(),
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'access' => $access,
            'status' => $status
        ]);

        $msg = 'You have successfully logrd in';

        return $response->withSession('msg', [$msg, 'alert'])->redirect($request->url()->getPath());
    }


    public function edit(Request $request, Response $response)
    {
        $user = $request->user();
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $id = $request->input('id');
        InputValidator::init([
            "uniqueField" => function (InputValidator $validator, string $field, string $message) {
                if ($validator->getValue() == '') {
                    return null;
                }
                if (UsersModel::findBy($field, $validator->getValue())) {

                    $validator->attachError($message);
                }
            }

        ]);

        $lastname->validate('required');
        $firstname->validate('required');

        if (!InputValidator::isValid()) {
            $errors = InputValidator::getErrors();

            return $response->withSession('msg', [$errors, 'error'])->redirect($request->url()->getPath());
        }

        UsersModel::findByPrimaryKeyAndUpdate($id, [
            'userid' => $user->id(),
            'firstname' => $firstname,
            'lastname' => $lastname,
        ]);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = "You have success fully updated your details";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    public function delete(Request $request, Response $response)
    {
        $id = $request->input('id');
        UsersModel::findByPrimaryKeyAndRemove($id);

        $url = explode('/', $request->url()->getPath());
        array_pop($url);
        $url = implode('/', $url);

        $msg = "You have successfully deleted";

        return $response->withSession('msg', [$msg, 'alert'])->redirect($url);
    }

    /**
     * @param $num number of colors to generate
     * 
     * @return array
     */
    public function genColor($num)
    {
        $colors = [];
        for ($i = 0; $i < $num; $i++) {
            $hex = '#';

            //Create a loop.
            foreach (array('r', 'g', 'b') as $color) {
                //Random number between 0 and 255.
                $val = mt_rand(0, 255);
                //Convert the random number into a Hex value.
                $dechex = dechex($val);
                //Pad with a 0 if length is less than 2.
                if (strlen($dechex) < 2) {
                    $dechex = "0" . $dechex;
                }
                //Concatenate
                $hex .= $dechex;
            }

            $colors[] = $hex;
        };

        return $colors;
    }

    public function displayTransaction(Request $request, Response $response)
    {
        $user = $request->user();
        $userid = $user->id();

        $transact = TransactionModel::findAllBy('userid', $userid);
        $credit = 0;
        $debit = 0;
        $sudo_credit = 0;
        $sudo_debit = 0;
        $wallet = 0;

        $trans_type = [
            TransactionProvider::CREDIT_TRANS => 'Credit',
            TransactionProvider::DEBIT_TRANS => 'Debit',
            TransactionProvider::SUDO_CREDIT_TRANS => 'Sudo Credit',
            TransactionProvider::SUDO_DEBIT_TRANS => 'Sudo Debit',
        ];

        foreach ($transact as $key) {

            $credit += $key->trans_type == TransactionProvider::CREDIT_TRANS ? $key->amount : 0;
            $debit += $key->trans_type == TransactionProvider::DEBIT_TRANS ? $key->amount : 0;
            $sudo_credit += $key->trans_type == TransactionProvider::SUDO_CREDIT_TRANS ? $key->amount : 0;
            $sudo_debit += $key->trans_type == TransactionProvider::SUDO_DEBIT_TRANS ? $key->amount : 0;

            $key->trans_type = $trans_type[$key->trans_type];
        }

        $wallet = $credit - $debit;
        $sudo_wallet = $sudo_credit- $sudo_debit;

        return $response->view('dashboard/wallet', [
            'transact' => $transact,
            'wallet' => $wallet,
            'credit' => $credit,
            'debit' => $debit,
            'sudo_wallet' => $sudo_wallet,
            'sudo_credit' => $sudo_credit,
            'sudo_debit' => $sudo_debit,
        ]);
    }

    public function addTransaction(Request $request, Response $response)
    {
        Auth::user();
        $user = $request->user();
        $userid = $user->id();
        $orgid = $user->id();
        $status = $request->url()->getQuery('status');
        $tx_ref = $request->url()->getQuery('tx_ref');
        $transaction_id = $request->url()->getQuery('transaction_id');


        function flutterWavePaymentVerification($trans_id)
        {
            try {
                $curl = curl_init();
                $secret_key  = 'FLWSECK-2744e4ff3bbf1a18e9721ca713a90719-X';

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$trans_id/verify",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => [
                        "accept: application/json",
                        "authorization: Bearer $secret_key",
                        "cache-control: no-cache"
                    ],
                ));

                return curl_exec($curl);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        function payStackPaymentVerification($reference)
        {
            try {
                $curl = curl_init();
                $api_key  = '';

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => [
                        "accept: application/json",
                        "authorization: Bearer $api_key",
                        "cache-control: no-cache"
                    ],
                ));

                return curl_exec($curl);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        if (isset($tx_ref) && isset($transaction_id)) {
            if ($status == 'successful') {
                $verification = flutterWavePaymentVerification($transaction_id);
            } else
                $status;
        } else{
            return $response->withSession('msg', ['Error occurs', 'alert'])->redirect('/dashboard/wallet');
        }

        $verification = json_decode($verification);
        $amount = $verification->data->amount;
        $pay_type = $verification->data->payment_type;
        $trans_type = TransactionProvider::CREDIT_TRANS; 

        

        TransactionModel::createEntry([
            'userid' => $userid,
            'orgid' => $orgid,
            'transaction_id' => $transaction_id,
            'status' => $status,
            'amount' => $amount,
            'pay_type' => $pay_type,
            'trans_type' => $trans_type,
        ]);

        return $response->redirect('/dashboard/wallet');
    }
}

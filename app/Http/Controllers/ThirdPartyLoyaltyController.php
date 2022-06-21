<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Classes\GoodtillClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ThirdPartyLoyaltyController extends Controller {

    /**
     * Login request. 
     * @param Request $request
     * @param GoodtillClient $goodtill_client
     * @return type
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function Login(Request $request, GoodtillClient $goodtill_client) {

        // Checking  csrf token
        $token = $request->session()->token();

        if ($token != $request->post('_token')) {
            throw new \Illuminate\Session\TokenMismatchException;
        }

        // Checking necessary fields.
        $validator = Validator::make($request->all(), [
                    'subdomain' => 'required',
                    'username' => 'required',
                    'password' => 'required',
        ]);

        // We should redirect user to login route if we had validation error.
        if ($validator->fails()) {
            return redirect('login')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            // We are open to send request to the API.
            $login_result = $goodtill_client->login($request->post('subdomain'), $request->post('username'), $request->post('password'));

            // If every thing was fine, user will be redirect to root route.
            if ($request->session()->get('error') == '') {
                $this->makeSessions($login_result);
                return redirect('/');
            }
        }

        // This view will be shown if we didn't have validation error, But we have login error in API.
        return view('login', [
            'body_class_name' => 'text-center',
        ]);
    }

    /**
     * User search. 
     * @param Request $request
     * @param GoodtillClient $goodtill_client
     * @return type
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function Search(Request $request, GoodtillClient $goodtill_client) {

        // Checking  csrf token
        $token = $request->session()->token();

        if ($token != $request->post('_token')) {
            throw new \Illuminate\Session\TokenMismatchException;
        }

        // Checking necessary fields.
        $validator = Validator::make($request->all(), [
                    'search_type' => 'required',
                    'query' => 'required',
        ]);

        // We should redirect user to /customers/search route if we had validation error.
        if ($validator->fails()) {
            return redirect('/customers/search')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            // We are open to send request to the API.
            // Checking for search type. we can search by name or user qr code.
            if ($request->post('search_type') == 'search') {
                $search = $request->post('query');
                $qr = '';
            } else {
                $search = '';
                $qr = $request->post('query');
            }

            $login_result = $goodtill_client->customers($search, $qr);

            // If every thing was fine, user will be redirect to root route.
            if ($request->session()->get('error') == '') {
                return Redirect::route('customers_show')->with(['data' => $login_result]);
            }
        }

        // This view will be shown if we didn't have validation error, But we have login error in API.
        return view('customers/search', [
            'body_class_name' => 'text-center',
        ]);
    }

    /**
     * This method is used by login method to make goodtill session in this application.
     * @param array $data
     */
    protected function makeSessions(array $data) {
        Session::put('goodtill', [
            'user_id' => $data['user_id'],
            'user_name' => $data['user_name'],
            'user_level' => $data['user_level'],
            'token' => $data['token'],
            'client_id' => $data['client_id'],
            'client_name' => $data['client_name'],
        ]);
    }

    /**
     * Show a specific user by user id.
     * @param Request $request
     * @param GoodtillClient $goodtill_client
     * @param string $id
     * @return type
     */
    public function Customer(Request $request, GoodtillClient $goodtill_client, string $id) {

        // We need to get all users from the API and then look for a specific user between them.
        $login_result = $goodtill_client->customers('', '');

        // This variable will keep user information.
        $user_info = [];

        // Finding user from users array.
        if ($request->session()->get('error') == '') {
            $users = $login_result['data'];
            foreach ($users as $key => $value) {
                if (in_array($id, $value)) {
                    $user_info = $users[$key];
                }
            }
        }

        return view('customers/show_one_user', [
            'body_class_name' => 'text-center',
            'user' => $user_info,
        ]);
    }

    /**
     * Adding new customer.
     * @param Request $request
     * @param GoodtillClient $goodtill_client
     * @return type
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function NewCustomer(Request $request, GoodtillClient $goodtill_client) {

        // Checking  csrf token
        $token = $request->session()->token();

        if ($token != $request->post('_token')) {
            throw new \Illuminate\Session\TokenMismatchException;
        }

        // Checking necessary fields.
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
        ]);

        // We should redirect user to login route if we had validation error.
        if ($validator->fails()) {
            return redirect('/customer/add/new')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            // We are open to send request to the API.
            $new_user_result = $goodtill_client->new_customer([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'phone' => $request->post('phone'),
            ]);

            // If every thing was fine, user will be redirect to root route.
            if ($request->session()->get('error') == '' && $new_user_result['success']) {
                $request->session()->flash('status', 'New customer has been added successfully!');
            } else {
                $request->session()->flash('error', 'New customer has not been added successfully!');
            }
        }

        // This view will be shown if we didn't have validation error, But we have login error in API.
        return view('customers/create', [
            'body_class_name' => 'text-center',
        ]);
    }

    /**
     * Complete sale based on JSON request.
     * @param Request $request
     * @param GoodtillClient $goodtill_client
     * @return type
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function CompleteSale(Request $request, GoodtillClient $goodtill_client) {

        // Checking  csrf token
        $token = $request->session()->token();

        if ($token != $request->post('_token')) {
            throw new \Illuminate\Session\TokenMismatchException;
        }

        // Checking necessary fields.
        $validator = Validator::make($request->all(), [
                    'query' => 'required',
        ]);

        // We should redirect user to login route if we had validation error.
        if ($validator->fails()) {
            return redirect('/sale/add')
                            ->withErrors($validator)
                            ->withInput();
        } else {

            // We are open to send request to the API.
            $new_user_result = $goodtill_client->complete_sale([
                'data' => $request->post('query'),
            ]);

            // If every thing was fine, user will be redirect to root route.
            if ($request->session()->get('error') == '' && $new_user_result['success']) {
                $request->session()->flash('status', 'New sale has been added successfully!');
            } else {
                $request->session()->flash('error', 'New sale has not been added successfully!');
            }
        }

        // This view will be shown if we didn't have validation error, But we have login error in API.
        return view('sale/add', [
            'body_class_name' => 'text-center',
        ]);
    }

}

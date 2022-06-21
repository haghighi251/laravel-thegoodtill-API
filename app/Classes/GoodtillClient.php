<?php

namespace App\Classes;

use Illuminate\Support\Facades\Session;

class GoodtillClient {

    public $token = null;
    public $outletId = null;
    public $vendorId = null;

    /**
     * Sends request to the API.
     * @param string $url
     * @param string $method
     * @param array $data
     * @return array
     */
    public function request(string $url, string $method = 'GET', array $data = []): array {

        $method = strtoupper($method);
        $request_url = 'https://api.thegoodtill.com/api/' . $url;

        if ($method == 'GET') {
            $request_url .= '?' . http_build_query($data);
        }

        $headers = [
            'Content-type: application/json',
            'User-Agent: GoodtillPhpClient (+https://support.thegoodtill.com/support/api/)',
        ];

        if ($this->token) {
            $headers[] = 'Authorization: Bearer ' . $this->token;
        }
        if ($this->outletId) {
            $headers[] = 'Outlet-Id: ' . $this->outletId;
        }
        if ($this->vendorId) {
            $headers[] = 'Vendor-Id: ' . $this->vendorId;
        }

        // Make request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $request_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($method != 'GET') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $responseBody = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        // Making PHP array by json result
        $parsedBody = json_decode($responseBody, true);

        // Check for errors
        if (empty($error) == false) {
            Session::flash('error', 'Unable to process request. Error: ' . json_encode($error, true));
            $parsedBody = [
                'token' => null,
                'success' => false,
                'error' => 'Unable to process request.Error:' . json_encode($error, true)
            ];
        }

        if ($responseCode > 400) {
            $errorMessage = $parsedBody['message'] ?? $parsedBody['error'] ?? $responseBody;
            Session::flash('error', 'Unable to process request. Error: ' . json_encode($errorMessage, true));
            $parsedBody = [
                'token' => null,
                'success' => false,
                'error' => 'Unable to process request. Error: ' . json_encode($errorMessage, true)
            ];
        }

        // Return data
        return $parsedBody;
    }

    /**
     * Sends login request.
     * @param string $subdomain
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login(string $subdomain, string $username, string $password): array {
        $data = $this->request(
                'login',
                'POST',
                [
                    'subdomain' => $subdomain,
                    'username' => $username,
                    'password' => $password,
                ]
        );

        $this->token = $data['token'];

        return $data;
    }

    /**
     * Gets customers list by search based on name or qr code.
     * @param string $search
     * @param string $qr
     * @return array
     */
    public function customers(string $search, string $qr): array {
        
        $data = $this->request(
                'customers',
                'GET',
                [
                    'search' => $search,
                    'qr' => $qr,
                ]
        );

        $this->token = $data['token'];

        return $data;
    }

    /**
     * Add new customer in API.
     * @param array $user_data
     * @return array
     */
    public function new_customer(array $user_data): array {
        
        $data = $this->request(
                'customer',
                'POST',
                $user_data
        );

        $this->token = $data['token'];

        return $data;
    }

    /**
     * Completes sale for specific user.
     * @param array $sale_data
     * @return array
     */
    public function complete_sale(array $sale_data): array {
        $data = $this->request(
                'sale',
                'POST',
                json_decode($sale_data['data'], true)
        );

        $this->token = $data['token'];

        return $data;
    }

}

<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function getProducts()
    {
        $url = 'http://laravel1911/api/product';
        $client = new Client();
        $token = $this->getLogin();
        if(!$token){
            return response()->json([
                'message' => 'not authorized',
                'stattus code' => 401
            ]);
        }
        $response = $client->get($url, [
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);

        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody(), true);
           return response()->json($result);

        }

        return "hello world";
    }

    public function getLogin()
    {
        $url = 'http://laravel1911/api/login';
        $client = new Client();
        try {
            $response = $client->post($url, [
                'form_params' => [
                    'name' => 'test',
                    'password' => '12345678'
                ]

            ]);
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody(), true);
                return $result['token'];
            }
        } catch(Exception $e) {
            return null;
        }

    }
}

<?php namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @property Client activeCampaign
 */
class Connection
{
    const CREDENTIALS = [
        'api_key' => '796bb394c125d6034a3c40cde99213831ccb02e0ac62f6a683b79a2d43ce9ae9e81e780f'
    ];

    function __construct()
    {
        $this->activeCampaign = new Client([
            'base_uri' => 'https://talently27145.api-us1.com',
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

        public function execEvent($event, $data, $debug = false)
    {
        $request = new Client([
            'base_uri' => 'https://trackcmp.net',
        ]);

        $data = [
            "actid" => "66678482",
            "key" => "70923d673893b68b5b8aaac0a3b4b9da8f9e0c5f",
            "event" => $event,
            "eventdata" => $data['event_value'],
            "visit" => [
                "email" => $data['email'],
            ]
        ];

        try {
            $response = $request->request('POST', '/event', [
                'debug' => $debug,
                'form_params' => $data
            ]);

            if ($response->getStatusCode() == 200) {
                header('Content-type: application/json');
                echo $response->getBody()->getContents();
            } else {
                echo $response->getStatusCode();
                echo $response->getBody()->getContents();
                echo 'no pasa nada';
            }

        } catch (GuzzleException $e) {
            echo '</br>---------- error ---------</br>';
            die($e->getMessage());
        }

    }

    public function exec($method, $data, $debug = false)
    {
        $data['api_action'] = $method;
        $data['api_key'] = $this::CREDENTIALS['api_key'];
        $data['api_output'] = 'json';

        try {
            $request = $this->activeCampaign->request('POST', 'admin/api.php', [
                'debug' => $debug,
                'form_params' => $data
            ]);

            if ($request->getStatusCode() == 200) {
                header('Content-type: application/json');
                echo $request->getBody()->getContents();
            } else {
                echo $request->getStatusCode();
                echo $request->getBody()->getContents();
                echo 'no pasa nada';
            }
        } catch (GuzzleException $e) {
            echo '</br>---------- error ---------</br>';
            die($e->getMessage());
        }
    }
}
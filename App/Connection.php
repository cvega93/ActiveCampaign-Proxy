<?php namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @property Client activeCampaign
 */
class Connection
{
    const CREDENTIALS = [
        'api_key' => 'f3fcb2063ca2c8bc00a40c26455bc135a992505fc3ffdba2045aff3196aedb50a75752e9'
    ];

    function __construct()
    {
        $this->activeCampaign = new Client([
            'base_uri' => 'https://monkeyfit.api-us1.com',
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }


    public function execEvent()
    {

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
<?php
namespace App;

/**
 * @property Connection activeCampaign
 */
class ActiveCampaign {
    public function __construct()
    {
        $this->activeCampaign = new Connection();
    }

    public function createClient($request)
    {
        if (!isset($request['email'])) die('Email requerido');
        if (!isset($request['firstName'])) die('Nombre requerido');
        if (!isset($request['lastName'])) die('Apellido requerido');

        $data = [
            'email' => $request['email'],
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName']
        ];

        if (isset($request['extraData'])) {
            foreach ($request['extraData'] as $key=>$value) {
                $data[$key] = $value;
            }
        }

        $this->activeCampaign->exec('contact_sync', $data);
    }

    public function updateClient($request)
    {
        if (!isset($request['email'])) die('Email requerido');

        $data = [
            'email' => $request['email'],
        ];

        if (isset($request['extraData'])) {
            foreach ($request['extraData'] as $key=>$value) {
                $data[$key] = $value;
            }
        }

        $this->activeCampaign->exec('contact_sync', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ConsulService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ConsulServiceController extends Controller
{
    public function __construct(private readonly ConsulService $consulService){}

    /**
     * @throws GuzzleException
     */
    public function callService()
    {
        $service = $this->consulService->discoverServices('service-1');
        $address = $service[0]['ServiceAddress'];
        $port = $service[0]['ServicePort'];

        $client = new Client();
        $response = $client->request('GET', "//$address:$port/api/endpoint");

        return $response->getBody();
    }
}

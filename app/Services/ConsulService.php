<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class ConsulService extends Controller
{
    private static Client $client;

    public function __construct()
    {
        self::$client = new Client(['base_uri' => "http://127.0.0.1:8500"]);
    }

    /**
     * @throws GuzzleException
     */
    public function registerService(string $name, string $id, string $address, int $port): StreamInterface
    {
        return self::$client->put('/v1/agent/service/register', [
            'json' => [
                'id'        => $id,
                'name'      => $name,
                'port'      => $port,
                'address'   => $address,
            ]
        ])->getBody();
    }

    /**
     * @throws GuzzleException
     */
    public function deregisterService(string $id): StreamInterface
    {
        return self::$client->put('/v1/agent/service/deregister/' . $id)->getBody();
    }

    /**
     * @throws GuzzleException
     */
    public function discoverServices($name)
    {
        $response = self::$client->get('/v1/catalog/service/'. $name);
        return json_decode($response->getBody(), true);
    }
}

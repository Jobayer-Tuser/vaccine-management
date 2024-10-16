<?php

namespace App\Console\Commands;

use App\Services\ConsulService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class RegisterConsulService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register the service with Consul';

    public function __construct(private readonly ConsulService $consulService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $this->consulService->registerService(name: 'vaccine-service', id: 'service-1', address: '127.0.0.1', port: 8000);
    }

    /**
     * @throws GuzzleException
     */
    public function __destruct()
    {
//        $this->consulService->deregisterService(id: 'service-1');
    }
}

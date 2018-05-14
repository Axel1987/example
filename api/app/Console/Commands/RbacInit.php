<?php

namespace App\Console\Commands;

use App\Contract\RbacInterface;
use Illuminate\Console\Command;
use App\Service\RbacService;

class RbacInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbac-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize (reset) roles permissions settings';

    /**
     * @var RbacService $rbac
     */
    protected $rbac;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->rbac = app()->make(RbacInterface::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->rbac->createRoles();

        echo ('Created roles is successfully' . PHP_EOL);
    }
}

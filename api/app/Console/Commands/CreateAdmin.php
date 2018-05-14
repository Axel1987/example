<?php

namespace App\Console\Commands;

use App\Contract\RbacInterface;
use App\Role;
use App\Service\RbacService;
use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the default administrator. !!A WARNING!! This command will remove all administrators';

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
        $this->rbac = app()->make(RbacInterface::class);

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::whereHas('userRole', function ($query) {
            $query->whereHas('role', function ($q) {
                $q->where(['name' => 'admin']);
            });
        })->delete();

        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@talent.com',
            'phone' => '123456',
            'password' => bcrypt('password'),
        ]);

        $user->save();
        $role = Role::where(['name' => 'admin'])->first();

        $this->rbac->attachRole($user, $role);


        echo('Created admin is successfully' . PHP_EOL);
    }
}

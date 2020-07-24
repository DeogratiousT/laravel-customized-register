<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Role;

class RolesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update roles stored in the database from roles defined in the roles config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $roles = config('roles.roles');

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']],
                [
                    'name' => $role['name'],
                    'slug' => $role['slug'],
                    'permissions' => $role['permissions'],
                ]
            );
        }

        $this->info('Successfully created/updated the defined roles');
    
    }
}

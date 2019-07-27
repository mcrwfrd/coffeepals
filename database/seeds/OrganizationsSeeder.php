<?php

use Illuminate\Database\Seeder;
use App\Organization;
use App\User;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Organization::class, 1)->create()->each(function ($organization) {
            factory(User::class, 50)->make()->each(function ($user) use (&$organization) {
               $organization->users()->save($user);
            });
        });
    }
}

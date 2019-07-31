<?php

use Illuminate\Database\Seeder;
use App\Organization;

class PairsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get the first organization or create one if none exist
        $organization = Organization::first();

        if (!$organization) {
            $this->call([
                OrganizationsSeeder::class,
            ]);
            $organization = Organization::first();
        }

        // run the pairallusers function inside that organization
        $organization->pairAllUsers();
    }
}

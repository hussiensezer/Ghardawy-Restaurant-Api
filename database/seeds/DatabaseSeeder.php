<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PermissionSeederTable::class);
         $this->call(AdminSeederTable::class);
         $this->call(OwnerSeederTable::class);
         $this->call(CaptionSeederTable::class);
    }
}

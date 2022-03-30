<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::create([
            'name'      => 'Super Admin',
            'email'     => 'super_admin@app.com',
            'phone'     => '01095454494',
            'password'  => bcrypt('123456'),
            'status'    => 1,
        ]);
        $user->assignRole("Super Admin");
    }
}

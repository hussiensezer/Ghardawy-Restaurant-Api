<?php

use App\Models\Owner;
use Illuminate\Database\Seeder;

class OwnerSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = Owner::create([
            'name'      => 'Hussien Attia',
            'phone'     => '01095454494',
            'email'     => 'hussiensezer@gmail.com',
            'password'  => bcrypt(123456),
            'status'    => 1,
            'admin_id'  => 1,
        ]);
    }
}

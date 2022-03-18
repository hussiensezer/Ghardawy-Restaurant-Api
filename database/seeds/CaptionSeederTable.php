<?php

use App\Models\Caption;
use Illuminate\Database\Seeder;

class CaptionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $caption = Caption::create([
           'name'      => 'Caption',
           'email'     => 'cation@app.com',
           'phone'     => '01095454494',
           'password'  => bcrypt('123456'),
           'status'    => 1,
           'online'    => 1,
           'latitude'  => 31.205753,
           'longitude' => 29.924526,
           'admin_id'  => 1
       ]);
    }
}

<?php

use App\Mail;
use Illuminate\Database\Seeder;

class MailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Mail::class, 40)->create();
    }
}

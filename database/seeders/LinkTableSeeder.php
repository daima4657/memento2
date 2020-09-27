<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
        	'title' => 'default_links',
        	'url' => 'default_url',
        	'description' => 'default_description',
        	]);
    }
}

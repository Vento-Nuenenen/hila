<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            ['id' => '1', 'group_name' => 'Migros'],
            ['id' => '2', 'group_name' => 'Coop'],
        ]);
    }
}

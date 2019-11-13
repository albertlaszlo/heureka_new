<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(3,10) as $id) {
            DB::table('tables')->insert([
                // 'id' => $id,
                'host_id' => 1,
                'name' => 'Table ' . $id,
                'nr_of_chairs' => 4,
            ]);
        }
    }
}

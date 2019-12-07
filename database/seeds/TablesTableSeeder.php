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
        foreach (range(1,10) as $host_id) {
            foreach (range(1, $host_id % 5 + 7) as $id) {
                DB::table('tables')->insert([
                    // 'id' => $id,
                    'host_id' => $host_id,
                    'name' => 'Table ' . $id,
                    'nr_of_chairs' => ($host_id + $id) % 6 + 1,
                ]);
            }
        }
    }
}

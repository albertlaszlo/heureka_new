<?php

use Illuminate\Database\Seeder;

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,10) as $id) {
            DB::table('hosts')->insert([
                // 'id' => $id,
                'description' => 'Desc '. $id,
                'name' => 'Host ' . $id,
                'city' => 'City ' . $id,
            ]);
        }
    }
}

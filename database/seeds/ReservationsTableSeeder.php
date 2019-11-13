<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 1,
            'email' => 'email@example.com',
            'start' => '2019-12-10 14:00',
            'end' => '2019-12-10 16:00',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 2,
            'email' => 'email@example.com',
            'start' => '2019-12-10 13:00',
            'end' => '2019-12-10 14:40',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 3,
            'email' => 'email@example.com',
            'start' => '2019-12-10 14:10',
            'end' => '2019-12-10 14:40',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 4,
            'email' => 'email@example.com',
            'start' => '2019-12-10 15:10',
            'end' => '2019-12-10 21:40',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 5,
            'email' => 'email@example.com',
            'start' => '2019-12-10 13:10',
            'end' => '2019-12-10 16:40',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 6,
            'email' => 'email@example.com',
            'start' => '2019-12-10 21:10',
            'end' => '2019-12-10 22:40',
        ]);

        DB::table('reservations')->insert([
            // 'id' => $id,
            'host_id' => 1,
            'table_id' => 7,
            'email' => 'email@example.com',
            'start' => '2019-12-10 11:10',
            'end' => '2019-12-10 12:40',
        ]);
    }
}

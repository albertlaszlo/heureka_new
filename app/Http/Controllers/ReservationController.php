<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Host;
use App\Image;
use App\Table;
use App\Reservation;

class ReservationController extends Controller
{
    function reserve(Request $request, Host $host) {
        $request->validate([
            'email' => 'required|email',
            'persons' => 'required|numeric|max:40',
        ]);
        
        $table = Table::where('host_id', $host->id)
            ->where('nr_of_chairs', '>=', $request->persons)
            ->orderBy('nr_of_chairs')
            // ->get();
            ->first();
        
        $toCreate = $request->all();
        $toCreate['table_id'] = $table->id;
        $toCreate['status'] = 'pending';
        return $host->reservations()->save(new Reservation($toCreate));
    }

    function index(Request $request, Host $host) {
        return $host->reservations()->with('table')->get();
    }

    function get(Request $request, Reservation $reservation) {
        $reservation->load('table');
        $reservation->load('host');
        return $reservation;
    }
}

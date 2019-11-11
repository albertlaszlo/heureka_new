<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Host;

class HostController extends Controller
{
    //
    function index(Request $request) {

        $search = $request->search;
        return Host::
            // select(['name', 'description'])
            where('name', "LIKE", "%$search%")
            ->orWhere('description', "LIKE", "%$search%")
            // ->whereIn('id', [1,2])
            ->orderBy('name')
            ->get();
    }

    function create(Request $request) {
        
        // return $request->all();

        $form = $request->all();
        dump ($form);
        return Host::create($request->all());
    }

    function delete(Host $host) {
        return $host->delete();
    }
}

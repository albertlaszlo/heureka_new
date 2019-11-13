<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Host;

class HostController extends Controller
{

    function reserve(Request $request, Host $host) {
        $request->validate([
            'email' => 'required|email',
            'nrOfChairs' => 'required|numeric|max:40',
        ]);

        return ['success'=> true];
    }

    function freeTables(Host $host) {
        return $host->freeTables('2019-12-10 14:00:00', '2019-12-10 16:00:00');
    }

    function index(Request $request) {
        return Host::search($request->search);
    }

    function create(Request $request) {
        $form = $request->all();
        return Host::create($request->all());
    }

    function delete(Host $host) {
        return $host->delete();
    }

    function fileUpload(Request $request) {
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            return [
                'message' => 'Upload success.',
                'path' => $path,
                'name' => 'logo',
                'status' => 200
            ];
        }

        return [
            'success' => false
        ];
    }
}

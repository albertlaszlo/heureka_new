<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Host;
use App\Image;

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
        // return $request->all();
        $request->validate([
            'start' => 'regex:/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/i',
            'end' => 'regex:/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/i',
        ]);
        return Host::search($request->search, '2019-12-10 14:00:00', '2019-12-10 16:00:00');
    }

    function create(Request $request) {
        $request->validate([
            'logo' => 'required|string',
            'name' => 'required|string',
            'city' => 'required|string',
            'description' => 'required|string',
            'images' => 'array|min:1',
            'images.*' => 'string',
        ]);

        $form = $request->all();
        $host = Host::create($request->all());
        foreach ($form["images"] as $image) {
            $host->images()->save(new Image(['image' => $image]));
        }
        $host ->load('images');
        return $host;
    }

    function delete(Host $host) {
        $success = $host->delete();
        return ['success' => $success];
    }

    function fileUpload(Request $request) {
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('logos', 'public');
        }

        if (isset($path)) {
            return [
                'message' => 'Upload success.',
                'path' => $path,
            ];
        }

        return [
            'success' => false
        ];
    }
}

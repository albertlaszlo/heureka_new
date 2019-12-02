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
        return Host::search($request->search);
    }

    function create(Request $request) {
        $form = $request->all();
        
        // $comment = new App\Comment(['message' => 'A new comment.']);
        // $post = App\Post::find(1);
        // $post->comments()->save($comment);
        $host = Host::create($request->all());
        foreach ($form["images"] as $image) {
            // dump (['image' => $image]);
            $host->images()->save(new Image(['image' => $image]));
        }
        $host ->load('images');
        return $host;


    }

    function delete(Host $host) {
        return $host->delete();
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

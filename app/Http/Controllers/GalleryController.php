<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'id'=> "posts",
            'menu'=>"gallery",
            'galleries' => Post::where('picture','!=','')->whereNotNull('picture')->orderBy('created_at','desc')->paginate(30),

        );

        // dd($data['galleries'][0]->picture);

        return view('gallery.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('picture')) {
            $filenameWithText = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithText, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();

            $smallFilename = "small {$basename}.{$extension}";
            $mediumFilename = "medium {$basename}.{$extension}";
            $largeFilename = "medium {$basename}.{$extension}";

            $filenameSave = "{$basename}.{$extension}";

            $path = $request->file('picture')->storeAs('post_picture', $filenameSave);

            $book = Post::create(['title' => $request->name, 'description' => $request->description, 'picture' => $path]);
        } else {
            $book = Post::create(['title' => $request->name, 'description' => $request->description]);
        }

        return redirect()->route('gallery.index')->with('success', 'Data created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

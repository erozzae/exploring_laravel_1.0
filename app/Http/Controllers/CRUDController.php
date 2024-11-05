<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('crud.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $filenameWithText = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithText, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameSave = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('images', $filenameSave);

            $book = Book::create(['name' => $request->name, 'description' => $request->description, 'image' => $path]);
        } else {
            $book = Book::create(['name' => $request->name, 'description' => $request->description]);
        }

        return redirect()->route('crud.index')->with('success', 'Data created successfully!');
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

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        return view('brands.index');
    }

    public function getData(){
        $brands = Brand::select(['name','location']);

        return DataTables::of($brands)->addIndexColumn()->make(true);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:15',
            'location' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validation->errors(),
                ],
                422,
            );
        }

        $brand = Brand::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data successfully added',
            'data' => $brand,
        ],201);
    }
}

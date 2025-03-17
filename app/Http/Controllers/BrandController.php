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

    public function getData()
    {
        $brands = Brand::select(['id', 'name', 'location']);

        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('action', function ($brand) {
                return "<button class='btn_edit btn btn-sm btn-primary' data-id='{$brand->id}'>Edit</button>
                    <button class='btn_delete btn btn-sm btn-danger' data-id='{$brand->id}'>Delete</button>";
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataById($id)
    {
        $brand = Brand::findOrFail($id);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $brand,
            ],
            200,
        );
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

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data successfully added',
                'data' => $brand,
            ],
            201,
        );
    }

    public function edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|max:15',
            'location' => 'string',
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

        $brand = Brand::findOrFail($id);
        $brand->update($request->all());

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Data successfully updated',
                'data' => $brand,
            ],
            200,
        );
    }

    public function delete($id){
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }
}

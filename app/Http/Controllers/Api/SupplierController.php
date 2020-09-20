<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::all();
        return response()->json($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
        ]);

        $supplier = new Suppliers();
        $supplier->fill($request->all());
        if($request->photo && $image_url = $this->storeImage($request->photo)) {
            $supplier->photo = '/'.$image_url;
        }

        $supplier->save();

        return response()->json(['success'=>'Employee saved successfully']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $supplier = Suppliers::findOrFail($id);

        return response()->json($supplier);
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);
        $currentImage = $supplier->photo;

         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $supplier->fill($request->all());

        if($request->new_photo && $image_url = $this->storeImage($request->new_photo)) {
            if($currentImage && file_exists($currentImage)) {
                unlink($currentImage);
            }
            $supplier->photo = '/'.$image_url;
        }

        $supplier->save();

        return response()->json(['success' => 'Employee successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Suppliers::findOrFail($id);
        if (!$supplier->delete()) {
            return response()->json(['error'=>'Employee don`t deleted!']);
        }

        if (file_exists($supplier->photo)) {
            unlink($supplier->photo);
        }

        return response()->json(['success' => 'Employee successfully deleted']);
    }

    /**
     * @param $photo
     * @return string
     */
    private function storeImage($photo)
    {
        $position = strpos($photo, ';');
        $sub = substr($photo, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($photo)->resize(240, 200);
        $upload_path = 'backend/employee/';
        $image_url = $upload_path.$name;
        $img->save($image_url);

        return $image_url;
    }
}

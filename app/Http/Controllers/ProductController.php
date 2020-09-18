<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'details' => $request->get('details'),
        ];

        $image = $request->file('image');
        if ($image_url = $this->prepareImage($image)) {
            $data['image'] = $image_url;
        }

        $product = Product::create($data);

        if (!$product) {
            return redirect()->back()->withErrors('Product not saved!');
        }

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = [
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'details' => $request->get('details'),
        ];

        $image = $request->file('image');
        if ($image instanceof UploadedFile) {
            $image_url = $this->prepareImage($image);
            if ($old_image = $request->get('old_image')) {
                unlink($old_image);
            }
            $data['image'] = $image_url;
        }

        $product->fill($data);

        if (!$product->save()) {
            return redirect()->back()->withErrors('Update error');
        }

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image_path = $product->image;

        if (!$product->delete()) {
            return redirect()->back()->withErrors('Product don`t deleted!');
        }

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->back()->with('success', 'Product successfully deleted');
    }

    private function prepareImage(UploadedFile $image)
    {
        $image_name = date('dmy_H_s_i');
        $ext = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'storage/images/products/';
        $image_url = $upload_path.$image_full_name;

        if ($image->move($upload_path, $image_full_name)) {
            return $image_url;
        }

        return false;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_Model;
use App\Models\ProductImage_Model;
use App\Models\ProductAccessories_Model;
use App\Models\Accessories_Model;
use App\Models\ProductSize_Model;
use App\Models\LeatherColor;
use App\Models\ProductLeather_Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product_Model::all();
        $productsize = ProductSize_Model::all();
        $productaccessories = ProductAccessories_Model::all();
        $data = compact('product', 'productsize', 'productaccessories');
        return view('product.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accessories = Accessories_Model::all();
        $leathers_color = LeatherColor::with('leathers')->get();
        // dd($leathers_color);
        $data = compact('accessories', 'leathers_color');
        return view('product.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:product',
                'model_no' => ['required', 'regex:/^[A-Z]{3}-\d{3}[A-Z]*$/', 'unique:product'],
                'notes' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cutting_cost' => 'required',
                'stitching_cost' => 'required',
                'option' => 'required',
            ]
        );
        $mainImage = $request->file('images')[0];
        $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
        $mainImage->move(public_path('images'), $mainImageName);
        $product = new Product_Model;
        $product->name = $request['name'];
        $product->model_no = $request['model_no'];
        $product->notes = $request['notes'];
        $product->cutting_cost = $request['cutting_cost'];
        $product->stitching_cost = $request['stitching_cost'];
        $product->image = $mainImageName;
        $product->save();
        //product mi
        foreach ($request->file('images') as $index => $image) {
            if ($index != 0) {
                $imageName = time() . '_1' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $productImage = new ProductImage_Model();
                $productImage->product_image = $imageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
            else{
                $productImage = new ProductImage_Model();
                $productImage->product_image = $mainImageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }
        //product image end
        if ($request->has('accessories')) {
            foreach ($request->accessories as $key => $accessorieId) {
                $productaccessories = new ProductAccessories_Model;
                $productaccessories->accessories_id = $accessorieId;
                $productaccessories->product_id = $product->id;
                if (isset ($request->accessory_quantities[$key])) {
                    $productaccessories->quantity = $request->accessory_quantities[$key];
                } else {
                    $productaccessories->quantity = 1;
                }
                $productaccessories->save();
            }
        }
        $productsize = new ProductSize_Model;
        $productsize->product_id = $product->id;
        foreach ($request->option as $selectedOption) {

            $newSize = new ProductSize_Model;
            $newSize->product_id = $product->id;
            $newSize->size = $selectedOption;
            $newSize->save();
        }
        $submitSuccess = true;
        return redirect('/product')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product_Model::find($id);
        $productImage = ProductImage_Model::where('product_id', $id)->first();
        $productsize = ProductSize_Model::where('product_id', $id)->first();
        $productaccessories = ProductAccessories_Model::with('Accessories')->where('product_id', $id)->first();
        $data = compact('product', 'productImage', 'productsize', 'productaccessories');
        return view('product.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product_Model::with('sizes')->with('images')->find($id);
        $accessories = Accessories_Model::all();
        $leathers_color = LeatherColor::all();
        $product = Product_Model::find($id);
        $productImage = ProductImage_Model::where('product_id', $id)->get();
        $productsize = ProductSize_Model::where('product_id', $id)->get();

        $productaccessories = ProductAccessories_Model::where('product_id', $id)->get();
        $product_leather = ProductLeather_Model::where('product_id', $id)->get();

        if (is_null($product)) {
            return redirect('/product');
        } else {
            $url = url('/product/update') . '/' . $id;
            $data = compact('product', 'productImage', 'productsize', 'productaccessories', 'url', 'accessories', 'leathers_color', 'product_leather', 'id');
            return view('product.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        // die;
        $request->validate(
            [
                'name' => 'required',
                'model_no' => ['required', 'regex:/^[A-Z]{3}-\d{3}[A-Z]*$/', 'unique:product,model_no,' . $id,],
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cutting_cost' => 'required',
                'stitching_cost' => 'required',
                'option' => 'required',
            ]
        );

        $mainImage = $request->file('images')[0];
        $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
        $mainImage->move(public_path('images'), $mainImageName);
        $product = Product_Model::with('sizes')->with('images')->find($id);
        $product->name = $request['name'];
        $product->model_no = $request['model_no'];
        $product->notes = $request['notes'];
        $product->cutting_cost = $request['cutting_cost'];
        $product->stitching_cost = $request['stitching_cost'];
        $product->image = $mainImageName;
        $product->save();
        //updating image process
        $product->images()->delete();
        foreach ($request->file('images') as $index => $image) {
            if ($index != 0) {
                $imageName = time() . '_1' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $productImage = new ProductImage_Model();
                $productImage->product_image = $imageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
            else{
                $productImage = new ProductImage_Model();
                $productImage->product_image = $mainImageName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }
        // update product size end

        $product->sizes()->delete();
        foreach ($request->option as $selectedOption) {

            $newSize = new ProductSize_Model;
            $newSize->product_id = $product->id;
            $newSize->size = $selectedOption;
            $newSize->save();
        }
        // update product size end
        $productaccessories = ProductAccessories_Model::where('product_id', $id)->get();

        if ($request->has('accessories')) {
            foreach ($request->accessories as $key => $accessorieId) {
                $productaccessory = $productaccessories->where('accessories_id', $accessorieId)->first();

                if (!$productaccessory) {
                    $productaccessory = new ProductAccessories_Model;
                    $productaccessory->product_id = $product->id;
                    $productaccessory->accessories_id = $accessorieId;
                }

                $productaccessory->quantity = isset ($request->accessory_quantities[$key]) ? $request->accessory_quantities[$key] : 1;
                $productaccessory->save();
            }
        }
        $updateSuccess = true;
        return redirect('/product')->with('updateSuccess', $updateSuccess);
    }


    public function destroy(string $id)
    {
        $product = Product_Model::find($id);

        if (!is_null($product)) {

            $imageFilename = $product->image;

            if (!is_null($imageFilename)) {
                $imagePath = public_path('images') . '/' . $imageFilename;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $DeleteSuccess = true;
            $product->delete();
        }

        return redirect('/product')->with('DeleteSuccess', $DeleteSuccess);
    }
}

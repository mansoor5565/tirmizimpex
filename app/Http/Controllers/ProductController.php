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
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product=Product_Model::all();
        $productsize=ProductSize_Model::all();
        $productaccessories=ProductAccessories_Model::all();
        $data=compact('product','productsize','productaccessories');
        return view('product.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accessories=Accessories_Model::all();
        $leathers_color=LeatherColor::with('leathers')->get();
        // dd($leathers_color);
        $data=compact('accessories','leathers_color');
        return view('product.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 'unique:product'
        $request->validate(
            [
                'name'=>'required|unique:product',
                'model_no' => ['required', 'regex:/^[A-Z]{3}-\d{3}[A-Z]*$/', 'unique:product'],
                'notes'=>'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cutting_cost'=>'required',
                'stitching_cost'=>'required',
                'option'=>'required',
            ]
            );
            $mainImage = $request->file('images')[0];
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->move(public_path('images'), $mainImageName);
            $product=new Product_Model;
            $product->name=$request['name'];
            $product->model_no=$request['model_no'];
            $product->notes=$request['notes'];
            $product->cutting_cost=$request['cutting_cost'];
            $product->stitching_cost=$request['stitching_cost'];
            $product->image=$mainImageName;
            // dd($request->all());
            // die;
            $product->save();
            //product mi
            foreach ($request->file('images') as $index => $image) {
                if($index != 0)
                {   
                    $imageName = time() . '_1' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    $productImage = new ProductImage_Model();
                    $productImage->product_image = $imageName;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }
            //product image end

            //product_leather
            // $product_leather=new ProductLeather_Model;
            // $product_leather->product_id=$product->id;
            // $product_leather->productcolor_id=$request['leather'];
            // $product_leather->save();
            //product accessories

            foreach ($request->accessories as $key => $accessorieId) {
                // Create a new instance of the ProductAccessories_Model
                $productaccessories = new ProductAccessories_Model;
            
                // Set the accessory id and product id
                $productaccessories->accessories_id = $accessorieId;
                $productaccessories->product_id = $product->id;
                if (isset($request->accessory_quantities[$key])) {
                    $productaccessories->quantity = $request->accessory_quantities[$key];
                } else {
                    // Default quantity if not specified
                    $productaccessories->quantity = 1; 
                }
            
                // Save the product accessory to the database
                $productaccessories->save();
            }
            $productsize = new ProductSize_Model;
            $productsize->product_id = $product->id;
            foreach ($request->option as $selectedOption) {
                
                $newSize = new ProductSize_Model;
                $newSize->product_id=$product->id;
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
        $productsize=ProductSize_Model::where('product_id',$id)->first();
        $productaccessories = ProductAccessories_Model::with('Accessories')->where('product_id', $id)->first();
        $data=compact('product','productImage','productsize','productaccessories');
        return view('product.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $accessories=Accessories_Model::all();
        $leathers_color=LeatherColor::all();
        $product = Product_Model::find($id);
        $productImage = ProductImage_Model::where('product_id', $id)->get();
        $productsize = ProductSize_Model::where('product_id', $id)->get();
    
        $productaccessories = ProductAccessories_Model::where('product_id', $id)->get();
        $product_leather = ProductLeather_Model::where('product_id', $id)->get();

        if(is_null($product)){
            return redirect('/product');
        }
        else{
             $url=url('/product/update').'/'.$id;
            $data=compact('product','productImage','productsize','productaccessories','url','accessories','leathers_color','product_leather','id');
            return view('product.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'=>'required',
                'model_no' => ['required', 'regex:/^[A-Z]{3}-\d{3}[A-Z]*$/', 'unique:product'],
                'notes'=>'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cutting_cost'=>'required',
                'stitching_cost'=>'required',
                'option'=>'required',
            ]
            );
        $product = Product_Model::find($id);
        $productImage = ProductImage_Model::where('product_id', $id)->first();
        $productsize = ProductSize_Model::where('product_id', $id)->first();
        $productaccessories = ProductAccessories_Model::where('product_id', $id)->get();
        $product_leather = ProductLeather_Model::where('product_id', $id)->first();
        // Update product details
        $product->name = $request['name'];
        $product->model_no = $request['model_no'];
        $product->notes = $request['notes'];
        $product->cutting_cost = $request['cutting_cost'];
        $product->stitching_cost = $request['stitching_cost'];

        if ($request->hasFile('image')) {
            $filename = time() . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('product_pictures'), $filename);
            $product->image = $filename;
        }

        $product->save();
        

        //product_leather
        // $product_leather->productcolor_id = $request->input('leather');
        // $product_leather->save();

        

        // Update product images
        if ($request->hasFile('file')) {
            $fileNames = [];
            foreach ($request->file('file') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $fileNames[] = $imageName;
            }
            $productImage->product_image = json_encode($fileNames);
            $productImage->save();
        }

        // Update product accessories
        foreach ($productaccessories as $key => $productAccessory) {
            $accessorie = $request->accessories[$key];
            $productAccessory->accessories_id = $accessorie;
            if (isset($request['accessory_quantities'][$key])) {
                $productAccessory->quantity = $request['accessory_quantities'][$key];
            } else {
                $productAccessory->quantity = 1; 
            }
            $productAccessory->save();
        }

        foreach ($request->option as $selectedOption) {
            $existingSize = $productsize->where('size', $selectedOption)->first();
            if ($existingSize) {
                $existingSize->update([
                    'product_id' => $product->id, 
                ]);
            } else {
                $newSize = new ProductSize_Model;
                $newSize->product_id = $product->id;
                $newSize->size = $selectedOption;
                $newSize->save();
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
            $imagePath = public_path('product_pictures') . '/' . $imageFilename;
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

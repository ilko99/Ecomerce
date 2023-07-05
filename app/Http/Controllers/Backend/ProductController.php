<?php

namespace App\Http\Controllers\Backend;

use Image;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();

        return view('backend.product.product_all', compact('products'));
    }

    public function AddProduct(){
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands','categories', 'activeVendors'));
    }

    public function StoreProduct(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(), 
        ]);

        // Multi Images Upload //

        $images = $request->file('multi_image');
        foreach($images as $image){
            $nake_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('upload/products/multi-image/'.$nake_name);
            $upload_path = 'upload/products/multi-image/'.$nake_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now()
            ]);
        } // end foreach


        $notification = array(
            'message' => 'Product created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id){
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = Subcategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('activeVendors','brands','categories','subcategory','product', 'multiImgs'));
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->id;

            Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(), 
        ]);
        $notification = array(
            'message' => 'Product updated without image',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }


    public function UpdateProductThumbnail(Request $request){
        $product_id = $request->id;
        $old_image = $request->old_image;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        if(file_exists($old_image)){
            unlink($old_image);
        }

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product image thumbnail updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateProductMultiimage(Request $request){
        $imgs = $request->multi_img;

        foreach($imgs as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $image = $request->file('product_thumbnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('upload/products/multi-image/'.$name_gen);
            $uploadedPath = 'upload/products/multi-image/'.$name_gen;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadedPath,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'Product Multi Images updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductMultiImgDelete($id){
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi Images deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductInactive($id){
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Product InActive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id){
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Product Is Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    
public function ProductDelete($id){
    $product = Product::findOrFAil($id);

    unlink($product->product_thumbnail);

    Product::findOrFail($id)->delete();

    $images = MultiImg::where('product_id', $id)->get();

    foreach($images as $image){
        unlink($image->photo_name);
        MultiImg::where('product_id', $id)->delete();
    }

    $notification = array(
        'message' => 'Product Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}


public function ProductStock(){
    $products = Product::latest()->get();

    return view('backend.product.product_stock', compact('products'));
}
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function ShopPage(){
        $products = Product::query();

        if(!empty($_GET['category'])){
            $slugs = explode(',', $_GET['category']);
            $catId = Category::select('id')->whereIn('category_slag', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id', $catId)->get();
        } elseif(!empty($_GET['brand'])){
            $slugs = explode(',', $_GET['brand']);
            $brandId = Brand::select('id')->whereIn('brand_slag', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('brand_id', $brandId)->get();
        }else{
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        }
        // Price Range
        if(!empty($_GET['price'])){
            $price = explode('-', $_GET['price']);
            $products = $products->whereBetween('selling_price', $price);
        }


        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $new_product = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.shop_page', compact('products', 'categories', 'new_product', 'brands'));
    }

    public function ShopFilter(Request $request){
        $data = $request->all();

        // Filter for category
        $cat_url = "";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($cat_url)){
                    $cat_url .= '&category='.$category;
                }else{
                    $cat_url .= ','.$category;
                }
            }
        }

        $brand_url = "";
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($cat_url)){
                    $brand_url .= '&brand='.$brand;
                }else{
                    $brand_url .= ','.$brand;
                }
            }
        }

        //// FILTER FOR THE PRICE RANGE
        $priceRangeUrl = "";
        if(!empty($data['price_range'])){
            $priceRangeUrl .= '&price='.$data['price_range'];
        }

        return redirect()->route('shop.page', $cat_url.$brand_url.$priceRangeUrl);
    }
}

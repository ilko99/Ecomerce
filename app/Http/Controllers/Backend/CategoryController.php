<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Images;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStore;

class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::latest()->get();

        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory(){
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request){

        // $validateData = $request->validated();
        // $category = Category::create($validateData);

        // if($request->hasFile('category_image')){
        //     $path = $request->file('category_image')->store('images', 'public');
        //     $category->image()->save(
        //         Images::make(['path' => $path])
        //     );

        // }

        // return redirect()->route('all.category', ['category' => $category->id])->with('success', 'Category created successfully');

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url
        ]);

        $notification = array(
            'message' => 'Category created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification); 
    }
   

    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    public function UpdateCategory(Request $request){

        $cat_id = $request->id;

        $old_image = $request->old_image;

        if($request->file('category_image')){
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

            if(file_exists($old_image)){
                unlink($old_image);
            }
           
        Category::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.category')->with($notification);
        } else {
            
            // without the image
            Category::findOrFail($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slag' => strtolower(str_replace(' ', '-',$request->category_name)),
            ]);
    
            $notification = array(
                'message' => 'Category updated successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.category')->with($notification);
        }
    }

    public function DeleteCategory($id){
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

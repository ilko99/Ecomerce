<?php

namespace App\Http\Controllers\Backend;

use Image;
use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function AllBlogCategory(){
        $blog_categories = BlogCategory::latest()->get();
        return view('backend.blog.category.blog_category_all', compact('blog_categories'));
    }

    public function AddBlogCategory(){
        return view('backend.blog.category.add_blog_category');
    }

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification); 
    }

    public function EditBlogCategory($id){
        $blog_category = BlogCategory::findOrFail($id);

        return view('backend.blog.category.edit_blog_category', compact('blog_category'));
    }

    public function UpdateBlogCategory(Request $request){
        $blog_id = $request->id;
        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification); 
    }

    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }


    ///////////////////////// Blog Post Methods
    
    public function AllBlogPost(){
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blog_post_all', compact('blogpost'));
    }

    public function AddBlogPost(){
        $blogcategory = BlogCategory::latest()->get();
        return view('backend.blog.post.add_blog_post', compact('blogcategory'));
    }

    public function StoreBlogPost(Request $request){
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url, 
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification); 
    }

    public function EditBlogPost($id){
        $blogcategory = BlogCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
       return view('backend.blog.post.blogpost_edit',compact('blogcategory','blogpost'));
   }// End Method 

   public function UpdateBlogPost(Request $request){

    $post_id = $request->id;
    $old_img = $request->old_image;

    if ($request->file('post_image')) {

    $image = $request->file('post_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
    $save_url = 'upload/blog/'.$name_gen;

    if (file_exists($old_img)) {
       unlink($old_img);
    }

    BlogPost::findOrFail($post_id)->update([
        'category_id' => $request->category_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
        'post_short_description' => $request->post_short_description,
        'post_long_description' => $request->post_long_description,
        'post_image' => $save_url, 
        'updated_at' => Carbon::now(),
    ]);

   $notification = array(
        'message' => 'Blog Post Updated with image Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.post')->with($notification); 

    } else {

        BlogPost::findOrFail($post_id)->update([
        'category_id' => $request->category_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
        'post_short_description' => $request->post_short_description,
        'post_long_description' => $request->post_long_description, 
        'updated_at' => Carbon::now(),
    ]);

   $notification = array(
        'message' => 'Blog Post Updated without image Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('admin.blog.post')->with($notification); 

    } // end else

}// End Method 

public function DeleteBlogPost($id){

    $blogpost = BlogPost::findOrFail($id);
    $img = $blogpost->post_image;
    unlink($img); 

    BlogPost::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Blog Post Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification); 

}// End Method 

//// Frontend blog post show
public function HomeBlog(){
    $blogpost = BlogPost::latest()->paginate(10);
    $blogcategories = BlogCategory::latest()->get();
    return view('frontend.blog.home_blog', compact('blogpost', 'blogcategories'));
}

public function BlogDetails($id, $post_slug){
    $blogcategories = BlogCategory::latest()->get();
    $blogdetails = BlogPost::findOrFail($id);
    $breadcrum = BlogCategory::where('id', $id)->get();
    return view('frontend.blog.blog_details', compact('blogcategories', 'blogdetails', 'breadcrum'));
}

public function PostCategory($id, $cat_slug){
    $blogcategories = BlogCategory::latest()->get();
    $blogpost = BlogPost::where('category_id', $id)->get();
    return view('frontend.blog.category_post', compact('blogcategories', 'blogpost'));
}
}



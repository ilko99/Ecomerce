<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function AllBanner(){
        $banners = Banner::latest()->get();

        return view('backend.banner.banner_all', compact('banners'));
    }

    public function AddBanner(){
        return view('backend.banner.banner_add');
    }

    public function StoreBanner(Request $request){
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url
        ]);

        $notification = array(
            'message' => 'Banner created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification); 
    }

    public function EditBanner($id){
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banner'));
    }

    public function UpdateBanner(Request $request){

        $banner_id = $request->id;

        $old_image = $request->old_image;

        if($request->file('banner_image')){
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

            if(file_exists($old_image)){
                unlink($old_image);
            }
           
        Banner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url
        ]);

        $notification = array(
            'message' => 'Banner updated successfully',
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.banner')->with($notification);
        } else {
            
            // without the image
            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,


            ]);
    
            $notification = array(
                'message' => 'Banner updated successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.banner')->with($notification);
        }
    }

    public function DeleteBanner($id){
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img);

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

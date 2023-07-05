<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request){
        $product_id = $request->product_id;
        $vendor_id = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor_id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Review will be reviewed and approved By an Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function PendingReview(){
        $review = Review::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('backend.review.pending_review', compact('review'));
    }

    public function ReviewApprove($id){
        Review::where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Review approved!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PublishedReview(){
        $review = Review::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('backend.review.approve_review', compact('review'));
    }

    public function ReviewDelete($id){
        Review::findOrFail($id)->delete();

        
        $notification = array(
            'message' => 'Review deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorAllReview(){
        $id = Auth::user()->id;

        $review = Review::where('vendor_id', $id)->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('vendor.backend.review.approve_review', compact('review'));

    }


    ////  FOR COMMENTS IN BLOG POSTS
    
    public function StoreComment(Request $request){
        $post_id = $request->postId;

        Comments::insert([
            'content' => $request->content,
            'blog_post_id' => $post_id
        ]);

        $notification = array(
            'message' => 'Comment posted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
    

}

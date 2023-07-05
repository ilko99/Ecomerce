@extends('frontend.master_dashboard')
@section('main')

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
               
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="single-page pt-50 pr-30">
                                <div class="single-header style-2">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">

        <h2 class="mb-10">{{$blogdetails->post_title}}</h2>
        <div class="single-header-meta">
            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                <a class="author-avatar" href="#">
                    <img class="img-circle" src="assets/imgs/blog/author-1.png" alt="" />
                </a>
                <span class="post-by">By <a href="#">Admin</a></span>
                <span class="post-on has-dot">{{Carbon\Carbon::parse($blogdetails->created_at)->diffForHumans()}}</span>
            </div>
            <div class="social-icons single-share">
                <ul class="text-grey-5 d-inline-block">
                    <li class="mr-5">
                        <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-bookmark.svg')}}" alt="" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<figure class="single-thumbnail">
<img src="{{asset($blogdetails->post_image)}}" style="height: 300px; width: 500px;" alt="" />
</figure>
<div class="single-content">
<div class="row">
    <div class="col-xl-10 col-lg-12 m-auto">
        <p class="single-excerpt">{!!$blogdetails->post_long_description!!}</p>
      
        <!--Entry bottom-->
        <div class="entry-bottom mt-50 mb-30">
            <div class="social-icons single-share">
                <ul class="text-grey-5 d-inline-block">
                    <li><strong class="mr-10">Share this:</strong></li>
                    <li class="social-facebook">
                        <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt="" /></a>
                    </li>
                    <li class="social-twitter">
                        <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt="" /></a>
                    </li>
                    <li class="social-instagram">
                        <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt="" /></a>
                    </li>
                    <li class="social-linkedin">
                        <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt="" /></a>
                    </li>
                </ul>
            </div>
        </div>

<!--Comment form-->
<div class="comment-form">
    <h3 class="mb-15">Leave a Comment</h3>
    <div class="row">
        <div class="col-lg-9 col-md-12">
            @auth
            <form class="form-contact comment_form mb-50" action="{{route('store.comment')}}" method="POST" id="commentForm">
                @csrf
                <input type="hidden" name="postId" value="{{$blogdetails->id}}">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea class="form-control w-100" name="content" placeholder="Write Comment"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="button button-contactForm">Post Comment</button>
                </div>
            </form>
            @else
            <p>please <a href="{{route('login')}}">login</a> to leave a comment</p>
            @endauth
  <div class="comments-area">
      <h3 class="mb-30">Comments</h3>
    <div class="comment-list">
        <div class="single-comment justify-content-between d-flex mb-30">
   <div class="user justify-content-between d-flex">

<div class="desc">
        @php
        $comments = App\Models\Comments::where('blog_post_id', $blogdetails->id)->orderBy('id', 'DESC')->get();
        @endphp
        @foreach($comments as $comment)
<p class="mb-10">{{$comment->content}}</p>
        @endforeach
</div>
    </div>
 </div>
 

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                            <div class="widget-area">
                                <div class="sidebar-widget-2 widget_search mb-50">
                                    <div class="search-form">
                                        <form action="#">
                                            <input type="text" placeholder="Search…" />
                                            <button type="submit"><i class="fi-rs-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="sidebar-widget widget-category-2 mb-50">
                                    <h5 class="section-title style-1 mb-30">Category</h5>
                                    <ul>
                                        @foreach($blogcategories as $category)
                                        @php
                                            $count = App\Models\BlogPost::where('category_id', $category->id)->get()
                                        @endphp
                                        <li>
                                            <a href="shop-grid-right.html">{{$category->blog_category_name}}</a><span class="count">{{count($count)}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<?php
$setting = App\Models\SiteSetting::find(1);
?>
<footer class="main">

    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="index.html" class="mb-15"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                            <p class="font-lg text-heading">EasyShop</p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{$setting->company_address}}</span></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{$setting->phone_one}}</span></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span>{{$setting->email}}</span></li>
                           
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('about.us') }}">About Us</a></li>
                        <li><a href="{{route('become.vendor')}}">Become a Vendor</a></li>
                        <li><a href="{{ route('home.blog') }}">Our blog</a></li>
                        <li><a href="{{ route('shop.page') }}">Our Shop</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{route('login')}}">Sign In</a></li>
                        @can('view_cart')
                        <li><a href="{{route('mycart')}}">View Cart</a></li>
                        <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                        <li><a href="{{ route('compare') }}">Compare products</a></li>
                        <li><a href="{{ route('user.track.order') }}">Track My Order</a></li>
                        <li><a href="{{ route('user.order.page') }}">Shipping Details</a></li>
                        
                        @endcan

                    </ul>
                </div>
               
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <h4 class="widget-title">Popular</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @php
                            $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(6)->get();
                        @endphp
                        @foreach($categories as $category)
                        <li><a href="{{url('product/category/'.$category->id.'/'.$category->category_slag)}}">{{$category->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2022, <strong class="text-brand">Easy</strong> - {{$setting->copyright}}</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>{{$setting->support_number}}<span>24/7 Support Center</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    <a href="{{$setting->facebook}}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                    <a href="{{$setting->twitter}}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                    <a href="{{$setting->youtube}}"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</footer>
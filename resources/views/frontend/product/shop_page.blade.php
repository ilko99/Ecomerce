@extends('frontend.master_dashboard')
@section('main')
@section('title')
    All products
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h1 class="mb-15"></h1>
                    <div class="breadcrumb">All Products
                        <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span>  All Products
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">

                @foreach($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishList(this.id)"  ><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn"  id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                                </div>
                            <?php
                                $discount = (($product->selling_price - $product->discount_price)/$product->selling_price)*100;
                            ?>
                            
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($product->discount_price == null)
                                    <span class="new">New</span>
                                    @else
                                    <span class="hot">{{round($discount)}}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{$product->category->category_name}}</a>
                                </div>
                                <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    @if($product->vendor_id == null)
                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                    @else
                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">{{$product->vendor->name}}</a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">

                                    @if($product->discount_price == null)
                                    <div class="product-price">
                                        <span>${{$product->selling_price}}</span>
                                    </div>
                                    @else
                                    <div class="product-price">
                                        <span>${{$product->discount_price}}</span>
                                        <span class="old-price">${{$product->selling_price}}</span>
                                    </div>
                                    @endif
                                    
                                    <div class="add-cart">
                                        <a class="add" href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><i class="fi-rs-shopping-cart mr-5"></i>Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--end product card-->


            </div>

            
        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            
             <!-- Fillter By Price -->
             <div class="sidebar-widget price_range range mb-30">

                <form method="post" action="{{route('shop.filter')}}">
                    @csrf
                <h5 class="section-title style-1 mb-30">Fill by price</h5>
                <div class="price-filter">
                    {{-- <div class="price-filter-inner">
                        <div id="slider-range" class="price-filter-range" data-min="0" data-max="10000"></div>
                        <input type="hidden" id="price_range" name="price_range" value="">
                        <input type="text" id="amount" value="$0 - $10000" readonly="">
                        <br><br>
                        <button type="submit" class="btn btn-sm btn-default">><i class="fi-rs-filter mr-5"></i> Filter</button>
                    </div> --}}
                    <div class="price-filter-inner">
                        <div id="slider-range" class="price-filter-range" data-min="0" data-max="10000"></div>
                        <input type="hidden" id="price_range" name="price_range" value="">
                        <input type="text" id="amount" value="$0 - $10000" readonly="">
                        <br><br>
                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Filter</button>
                    </div>
                </div>
                <div class="list-group">
                    <div class="list-group-item mb-10 mt-10">
                        {{-- Category checkboxes --}}
                        @if(!empty($_GET['category']))
                            @php
                                $filterCat = explode(',',$_GET['category'])
                            @endphp
                        @endif
                        <label class="fw-900">Categories</label>
                        @foreach($categories as $cat)
                        @php
                        $product = App\Models\Product::where('category_id', $cat->id)->get()
                        @endphp
                        <div class="custome-checkbox">       
                            <input class="form-check-input" type="checkbox" name="category[]" id="exampleCheckbox{{$cat->id}}" value="{{$cat->category_slag}}" @if(!empty($filterCat) && in_array($cat->category_slag, $filterCat)) checked @endif onchange="this.form.submit()"/>
                            <label class="form-check-label" for="exampleCheckbox{{$cat->id}}"><span>{{$cat->category_name}} ({{count($product)}})</span></label>
                        </div>
                        @endforeach
                        {{-- Brands checkboxes --}}

                        @if(!empty($_GET['brand']))
                            @php
                                $filterBrand = explode(',',$_GET['brand'])
                            @endphp
                        @endif

                        <label class="fw-900 mt-15">Brand</label>
                        @foreach($brands as $brand)
                        <div class="custome-checkbox">       
                            <input class="form-check-input" type="checkbox" name="brand[]" id="exampleBrand{{$brand->id}}" value="{{$brand->brand_slag}}" @if(!empty($filterBrand) && in_array($brand->brand_slag, $filterBrand)) checked @endif onchange="this.form.submit()"/>
                            <label class="form-check-label" for="exampleBrand{{$brand->id}}"><span>{{$brand->brand_name}}</span></label>
                        </div>
                        @endforeach
                    </div>
                </div>

                </form>

            </div>
            
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                @foreach($new_product as $product)
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="{{asset($product->product_thumbnail)}}" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h5><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{$product->product_name}}</a></h5>
                        @if($product->discount_price == null)
                        <p class="price mb-0 mt-5">${{$product->selling_price}}</p>
                        @else
                        <p class="price mb-0 mt-5">${{$product->discount_price}}</p>
                        @endif
                        <div class="product-rate">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        if($('#slider-range').length > 0){
            const max_price = parseInt($('#slider-range').data('max'));
            const min_price = parseInt($('#slider-range').data('min'));
            let price_range = min_price+"-"+max_price;

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_price,
                max: max_price  ,
                values: price,
    
                slide: function (event, ui) {
                $("#amount").val('$'+ui.values[0]+"-"+'$'+ui.values[1]);
                $("#price_range").val(ui.values[0]+"-"+ui.values[1]);
                }
            });
        }
    })
</script>


@endsection

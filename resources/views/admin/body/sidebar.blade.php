<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('adminbackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if(Auth::user()->can('brand.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                @if(Auth::user()->can('brand.list'))
                <li> <a href="{{route('all.brand')}}"><i class="bx bx-right-arrow-alt"></i>All brand</a>
                </li>
                @endif
                @if(Auth::user()->can('brand.add'))
                <li> <a href="{{route('add.brand')}}"><i class="bx bx-right-arrow-alt"></i>Add brand</a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        
        @if(Auth::user()->can('cat.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                @if(Auth::user()->can('cat.list'))
                <li> <a href="{{route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                </li>
                @endif
                @if(Auth::user()->can('cat.add'))
                <li> <a href="{{route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add category</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('subcat.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">SubCategory</div>
            </a>
            <ul>
                @if(Auth::user()->can('subcat.list'))
                <li> <a href="{{route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
                </li>
                @endif
                @if(Auth::user()->can('subcat.add'))
                <li> <a href="{{route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if(Auth::user()->can('product.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product manage</div>
            </a>
            <ul>
                @if(Auth::user()->can('product.list'))
                <li> <a href="{{route('all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                @endif
                @if(Auth::user()->can('product.add'))
                <li> <a href="{{route('add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Slider manager</div>
            </a>
            <ul>
                <li> <a href="{{route('all.slider')}}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href="{{route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Banner Message</div>
            </a>
            <ul>
                <li> <a href="{{route('all.banner')}}"><i class="bx bx-right-arrow-alt"></i>All Banners</a>
                </li>
                <li> <a href="{{route('add.banner')}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href="{{route('all.division')}}"><i class="bx bx-right-arrow-alt"></i>All Divisions</a>
                </li>
                <li> <a href="{{route('all.district')}}"><i class="bx bx-right-arrow-alt"></i>All Districts</a>
                </li>
                <li> <a href="{{route('all.state')}}"><i class="bx bx-right-arrow-alt"></i>All States</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Order Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('pending.order')}}"><i class="bx bx-right-arrow-alt"></i>Pending orders</a>
                </li>
                <li> <a href="{{route('confirmed.order')}}"><i class="bx bx-right-arrow-alt"></i>Confirmed orders</a>
                </li>
                <li> <a href="{{route('processing.order')}}"><i class="bx bx-right-arrow-alt"></i>Processing orders</a>
                </li>
                <li> <a href="{{route('delivered.order')}}"><i class="bx bx-right-arrow-alt"></i>Delivered orders</a>
                </li>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Return Order</div>
            </a>
            <ul>
                <li> <a href="{{route('return.request')}}"><i class="bx bx-right-arrow-alt"></i>Return Requests</a>
                </li>
                <li> <a href="{{route('complete.return.request')}}"><i class="bx bx-right-arrow-alt"></i>Complete Return Requests</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                <li> <a href="{{route('site.setting')}}"><i class="bx bx-right-arrow-alt"></i>Site Settings</a>
                </li>
                <li> <a href="{{route('seo.setting')}}"><i class="bx bx-right-arrow-alt"></i>SEO Settings</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                </li>
            </ul>
        </li>



        <li class="menu-label">UI Elements</li>
       
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
                <li> <a href="{{route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Report Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('report.view')}}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
                </li>
                <li> <a href="{{route('order.by.user')}}"><i class="bx bx-right-arrow-alt"></i>Order by user</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">User Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all-users')}}"><i class="bx bx-right-arrow-alt"></i>All Users</a>
                </li>
                <li> <a href="{{route('all-vendor')}}"><i class="bx bx-right-arrow-alt"></i>All Vendors</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Blog Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category')}} "><i class="bx bx-right-arrow-alt"></i>All Blog Categories</a>
                </li>
                <li> <a href="{{ route('admin.blog.post')}}"><i class="bx bx-right-arrow-alt"></i>All blog posts</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Review Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review')}} "><i class="bx bx-right-arrow-alt"></i>Pending Reviews</a>
                </li>
                <li> <a href="{{ route('published.review')}}"><i class="bx bx-right-arrow-alt"></i>Published reviews</a>
                </li>
            </ul>
        </li>
       
        @if(Auth::user()->can('admin.user.menu'))
        <li class="menu-label">Roles and permissions</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Roles and permissions</div>
            </a>
            <ul>
                <li> <a href="{{route('all.permission')}}"><i class="bx bx-right-arrow-alt"></i>All Permissions</a>
                </li>
                <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>
                <li> <a href="{{route('add.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>Roles in Permission</a>
                </li>
                <li> <a href="{{route('all.roles.permission')}}"><i class="bx bx-right-arrow-alt"></i>All in Permission</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Admin manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all.admin')}}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                </li>
                <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                </li>
            </ul>
        </li>
        @endif

        <li>
           
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
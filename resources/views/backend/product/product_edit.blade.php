@extends('admin.admin_dashboard')

@section('admin')





<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Edit Product</h5>
          <hr/>
          <form id="myForm" method="post" action="{{route('update.product')}}" enctype="multipart/form-data" >
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}">
           <div class="form-body mt-4">
            <div class="row">
               <div class="col-lg-8">
               <div class="border border-3 p-4 rounded">
                <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" value="{{$product->product_name}}" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                    <input type="text" name="product_tags" value="{{$product->product_tags}}" class="form-control visually-hidden" data-role="tagsinput" value="new product,top product">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Size</label>
                    <input type="text" name="product_size" value="{{$product->product_size}}" class="form-control visually-hidden" data-role="tagsinput" value="Small,Medium,Large">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Collor</label>
                    <input type="text" name="product_color" value="{{$product->product_color}}" class="form-control visually-hidden" data-role="tagsinput" value="Red,Blue.Black">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductDescription" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3">{{$product->short_description}}</textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductDescription" class="form-label">Long Description</label>
                    <textarea name="long_description" id="mytextarea" class="form-control" id="inputProductDescription" rows="3">{!! $product->long_description !!}</textarea>
                  </div>
                 





                  
                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" name="selling_price" id="inputPrice" value="{{$product->selling_price}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                        <input type="text" class="form-control" name="discount_price" id="inputCompareatprice" value="{{$product->discount_price}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputCostPerPrice" class="form-label">Product code</label>
                        <input type="text" name="product_code" class="form-control" id="inputCostPerPrice" value="{{$product->product_code}}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                        <input type="text" name="product_quantity" class="form-control" id="inputStarPoints" value="{{$product->product_quantity}}">
                      </div>



                      <div class="form-group col-12">
                        <label for="inputProductType" class="form-label">Product Brand</label>
                        <select name="brand_id" selected class="form-select" id="inputProductType">
                            <option selected></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }} >{{ $brand->brand_name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="inputVendor" class="form-label">Product Category</label>
                        <select name="category_id" class="form-select" id="category_id">
                            <option selected></option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}" {{ $cat->id == $product->category_id ? 'selected' : ''}}>{{$cat->category_name}}</option>

                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label name="subcategory_id" for="inputCollection" class="form-label">Product Subcategory</label>
                        <select class="form-select" name="subcategory_id" id="subcategory_id">
                            <option selected></option>
                            @foreach ($subcategory as $subcat)
                            <option value="{{ $subcat->id }}" {{ $subcat->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label name="vendor_id" for="inputCollection" class="form-label">Select Vendor</label>
                        <select class="form-select" id="inputCollection">
                            <option selected></option>
                            @foreach ($activeVendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $vendor->id == $product->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                            @endforeach
                          </select>
                      </div>


                      <div class="form-group col-12">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->hot_deals == 1 ? 'checked' : '' }} >
                                    <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault" {{ $product->featured == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault">Special Deal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                      <div class="form-group col-12">
                          <div class="d-grid">
                             <input type="submit" class="btn btn-primary px-4" value="Save changes">
                          </div>
                      </div>
                  </div> 
              </div>
              </div>
           </div><!--end row-->
        </div>
      </div>
    </form>
  </div>
</div>


{{-- Main Image Thumbnail Update --}}
<div class="page-content">
  <h6 class="mb-0 text-uppercase">Update Main image thimbnail</h6>
  <hr>
  <div class="card">
    <form method="POST" action="{{route('update.product.thumbnail')}}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{$product->id}}">
      <input type="hidden" name="old_image" value="{{$product->product_thumbnail}}">
    <div class="card-body">
      <div class="mb-3">
        <label for="" class="form-label">Choose thumbnail image</label>
        <input type="file" name="product_thumbnail" class="form-control" id="formFile">
      </div>
      <div class="mb-3">
        <label for="" class="form-label"></label>
        <img src="{{asset($product->product_thumbnail)}}" style="width:100px; height:100px" alt="">
      </div>
      <input type="submit" class="btn btn-primary px-4" value="Save changes">
    </div>
    </form>
  </div>
</div>

<!-- /// Update Multi Image  ////// -->

<div class="page-content">
	<h6 class="mb-0 text-uppercase">Update Multi Image </h6>
	<hr>
<div class="card">
<div class="card-body">
	<table class="table mb-0 table-striped">
		<thead>
			<tr>
				<th scope="col">#Sl</th>
				<th scope="col">Image</th>
				<th scope="col">Change Image </th>
				<th scope="col">Delete </th>
			</tr>
		</thead>
		<tbody>

 <form method="post" action="{{route('update.product.multiimage')}}" enctype="multipart/form-data" >
			@csrf
	@foreach($multiImgs as $key => $img)
	<tr>
		<th scope="row">{{ $key+1 }}</th>
		<td> <img src="{{ asset($img->photo_name) }}" style="width:70; height: 40px;"> </td>
		<td> <input type="file" class="form-group" name="multi_img[{{ $img->id }}]"> </td>
		<td> 
	<input type="submit" class="btn btn-primary px-4" value="Update Image " />		
	<a href="{{route('product.multiimg.delete', $img->id)}}" class="btn btn-danger" id="delete"> Delete </a>		
		</td>
	</tr>
	@endforeach		 

		</form>	 
		</tbody>
	</table>
</div>
</div>
</div>


<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              product_name: {
                  required : true,
              }, 
              short_description: {
                  required : true,
              }, 
               product_thambnail: {
                  required : true,
              }, 
              multi_image: {
                  required : true,
              }, 
               selling_price: {
                  required : true,
              },                   
               product_code: {
                  required : true,
              }, 
              product_quantity: {
                  required : true,
              }, 
               brand_id: {
                  required : true,
              }, 
               category_id: {
                  required : true,
              }, 
               subcategory_id: {
                  required : true,
              }, 
          },
          messages :{
              product_name: {
                  required : 'Please Enter Product Name',
              },
              short_description: {
                  required : 'Please Enter Short Description',
              },
              product_thambnail: {
                  required : 'Please Select Product Thambnail Image',
              },
              multi_image: {
                  required : 'Please Select Product Multi Image',
              },
              selling_price: {
                  required : 'Please Enter Selling Price',
              }, 
              product_code: {
                  required : 'Please Enter Product Code',
              },
              product_quantity: {
                  required : 'Please Enter Product Quantity',
              },
          },
          errorElement : 'span', 
          errorPlacement: function (error,element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight : function(element, errorClass, validClass){
              $(element).addClass('is-invalid');
          },
          unhighlight : function(element, errorClass, validClass){
              $(element).removeClass('is-invalid');
          },
      });
  });
  
</script>

<script type="text/javascript">
  		
  $(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
      var category_id = $(this).val();
      if (category_id) {
        $.ajax({
          url: "{{ url('/subcategory/ajax') }}/"+category_id,
          type: "GET",
          dataType:"json",
          success:function(data){
            $('select[name="subcategory_id"]').html('');
            var d =$('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
            });
          },
        });
      } else {
        alert('danger');
      }
    });
  });
</script>




@endsection
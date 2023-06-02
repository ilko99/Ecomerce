@extends('admin.admin_dashboard')

@section('admin')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add New Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Add New Product</h5>
          <hr/>
          <form id="myForm" method="post" action="{{ route('store.product') }}" enctype="multipart/form-data" >
            @csrf
           <div class="form-body mt-4">
            <div class="row">
               <div class="col-lg-8">
               <div class="border border-3 p-4 rounded">
                <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                    <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="new product,top product">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Size</label>
                    <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="Small,Medium,Large">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Collor</label>
                    <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="Red,Blue.Black">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductDescription" class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductDescription" class="form-label">Long Description</label>
                    <textarea name="long_description" id="mytextarea" class="form-control" id="inputProductDescription" rows="3"></textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Main Thumbnail</label>
                   <input class="form-control" type="file" id="product_thumbnail" name="product_thumbnail">
                  </div>
                  <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Multiple Images</label>
                    <input type="file" id="formFileMultiple" multiple="" name="multi_image[]" class="form-control">
                  </div>
                  
                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" name="selling_price" id="inputPrice" placeholder="00.00">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                        <input type="text" class="form-control" name="discount_price" id="inputCompareatprice" placeholder="00.00">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputCostPerPrice" class="form-label">Product code</label>
                        <input type="text" name="product_code" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                        <input type="text" name="product_quantity" class="form-control" id="inputStarPoints" placeholder="00.00">
                      </div>



                      <div class="form-group col-12">
                        <label for="inputProductType" class="form-label">Product Brand</label>
                        <select name="brand_id" class="form-select" id="inputProductType">
                            <option></option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="inputVendor" class="form-label">Product Category</label>
                        <select name="category_id" class="form-select" id="category_id">
                            <option></option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label name="subcategory_id" for="inputCollection" class="form-label">Product Subcategory</label>
                        <select class="form-select" name="subcategory_id" id="subcategory_id">
                            <option></option>

                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label name="vendor_id" for="inputCollection" class="form-label">Select Vendor</label>
                        <select class="form-select" id="inputCollection">
                            <option></option>
                            @foreach ($activeVendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach
                          </select>
                      </div>


                      <div class="form-group col-12">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexChackDefault" name="hot_deals" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexChackDefault" name="featured" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexChackDefault" name="special_offer" value="1">
                                    <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexChackDefault" name="special_deals" value="1">
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
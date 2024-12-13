@extends('admin.partials.layout')
@section('css')

<link href="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">

<style>

    .invalid-feedback{
      display: block;
   }

   .form-group {
    margin-bottom: 10px;
   }

   .select2-container{
    width: 100%!important;
   }

   .select2-dropdown {
    z-index: 1124!important;
   }

</style>

<link href="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<link href="{{asset('admin/assets/css/pages/user-card.css')}}" rel="stylesheet" />

@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit 
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form id="product-from" method="post" action="{{URL::to('admin/products')}}/{{Crypt::encryptString($product->id)}}">
            @csrf
            @method('put')
 
            <div class="row">
                <div class="col-md-12">

                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white" >General Details</h4>
                        </header>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" >Title</label>
                                            <input value="{{$product->title}}" name="title" class="form-control" 
                                            placeholder="Title">
                                            @if($errors->has('title'))
                                             <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <input type="text" value="{{$product->short_description}}" name="short_description" class="form-control" 
                                            placeholder="Description">
                                            @if($errors->has('short_description'))
                                             <p class="invalid-feedback" >{{ $errors->first('short_description') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" >Sku</label>
                                            <input value="{{$product->sku}}" name="sku" class="form-control" 
                                            placeholder="Sku">
                                            @if($errors->has('sku'))
                                             <p class="invalid-feedback" >{{ $errors->first('sku') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Price</label>
                                            <input type="number" value="{{$product->price}}" name="price" class="form-control" 
                                            placeholder="Price" step="0.01" min="0">
                                            @if($errors->has('price'))
                                            <p class="invalid-feedback" >{{ $errors->first('price') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Category</label>
                                            <input type="text" value="{{$product->category}}" name="category" class="form-control" 
                                            placeholder="Category">
                                            @if($errors->has('category'))
                                            <p class="invalid-feedback">{{$errors->first('category') }}
                                            </p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Unit</label>
                                            <input type="text" value="{{$product->unit}}" name="unit" class="form-control" 
                                            placeholder="Unit">
                                            @if($errors->has('unit'))
                                            <p class="invalid-feedback">{{$errors->first('unit') }}
                                            </p>
                                            @endif 
                                        </div>
                                    </div>
                             </div>
                        </div>
                    </section>

                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white">Details</h4>
                        </header>
                        <div class="card-body"> 
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea rows="10" cols="10" placeholder="Details..." class="form-control" 
                                    name="long_description">{{$product->long_description}}</textarea>
                                    @if($errors->has('long_description'))
                                    <p class="invalid-feedback" >{{ $errors->first('long_description') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>


                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white">Image</h4>
                        </header>
                        <div class="card-body">       
                                <div class="form-group my-2" > 
                                    <input name="image" type="file" />
                                    @if($errors->has('image'))
                                     <p class="invalid-feedback">{{$errors->first('image') }}</p>
                                    @endif 
                                </div>
                          </div>
                    </section>
             </div>
         </div>

         <div class="pt-3 form-group row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
         </div>

       </form>
    </div>
</div>
@endsection
@section('js')

<script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>


<script>
    //  $(function () {
        
    //         ClassicEditor.create(document.querySelector('#long_description')).catch(error => {
    //             console.error(error);
    //         });
           

    //         var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    //         $('.js-switch').each(function () {
    //             new Switchery($(this)[0], $(this).data());
    //         });        
    // });   

    $(document).ready(function() {



    $('.select3').select2();
    // var currentUrl = window.location.href;
    // $('.perent_Product ul li a').each(function() {
    //     $('.product-link-tag').addClass('active');
    //     $(this).closest('ul').addClass('show');
    // });




    // $('#btnSubmit').click(function() {
        
    //     var id = $('input[name="id"]').val();
    //     var titleValue = $('input[name="title"]').val();
    //     var slugValue = $('input[name="slug"]').val();
    //     var priceValue = $('input[name="price"]').val();
    //     var selling_priceValue = $('input[name="selling_price"]').val();
    //     var meta_titleValue = $('input[name="meta_title"]').val();
    //     var meta_keywordsValue = $('input[name="meta_keywords"]').val();

        
    //     var details = $('textarea[name="details"]').val();
    //     var description = $('textarea[name="description"]').val();

    
    //     var imageValue = $('select[name="image"]').val();
    //     var hover_imageValue = $('select[name="hover_image"]').val();
    //     var selectedCategoryId = $('select[name="category_id"]').val();

        
    //     var selectedCollections = [];
    //     $('input[name^="collections"]:checked').each(function() {
    //         selectedCollections.push($(this).val());
    //     });

        
    //     var selectedImages = $('#gallery').val();
    //     console.log(id);
        

    //     $.ajax({
            // url: ''', 
    //         method: 'POST',
    //         dataType: 'json',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             id: id,
    //             title: titleValue,
    //             slug: slugValue,
    //             price: priceValue,
    //             selling_price: selling_priceValue,
    //             meta_title: meta_titleValue,
    //             meta_keywords: meta_keywordsValue,
    //             details: details,
    //             description: description,
    //             image: imageValue,
    //             hover_image: hover_imageValue,
    //             category_id: selectedCategoryId,
    //             collections: selectedCollections,
    //             gallery: selectedImages
    //         },
    //         success: function(response) {
    //             alert(response.success)
    //         },
    //         error: function(xhr, status, error) {
                
    //             alert(status,error)
                
    //         }
    //     });
    // });


});

</script>
@endsection
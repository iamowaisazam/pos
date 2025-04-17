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
        <form  enctype="multipart/form-data" method="post" 
            action="{{URL::to('admin/products')}}/{{Crypt::encryptString($product->id)}}">
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
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-label">Title <span class="text-danger" >*</span></label>
                                            <input value="{{$product->title}}" name="title" class="form-control" 
                                            placeholder="Title">
                                            @if($errors->has('title'))
                                             <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                            @endif 
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" >Sku <span class="text-danger" >*</span></label></label>
                                            <input value="{{$product->sku}}" name="sku" class="form-control" 
                                            placeholder="Sku">
                                            @if($errors->has('sku'))
                                             <p class="invalid-feedback" >{{ $errors->first('sku') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"> <span class="text-danger" >*</span> Category</label>
                                            <select name="category_id" class="form-control" >
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                  <option @if($item->id == $product->category_id) selected @endif  value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('category_id'))
                                               <p class="invalid-feedback">{{$errors->first('category_id') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Unit 
                                                <span class="text-danger">*</span></label></label>
                                            <select name="unit_id" class="form-control" >
                                                <option value="">Select Unit</option>
                                                @foreach ($units as $item)
                                                  <option @if($item->id == $product->unit_id) selected @endif value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('unit_id'))
                                                  <p class="invalid-feedback">{{$errors->first('unit_id')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Price <span class="text-danger" >*</span></label></label>
                                            <input type="number" value="{{$product->price}}" name="price" class="form-control" 
                                            placeholder="Price" step="0.01" min="0">
                                            @if($errors->has('price'))
                                            <p class="invalid-feedback" >{{ $errors->first('price') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"> <span class="text-danger" >*</span> Purchase Price</label>
                                            <input type="number" value="{{$product->purchase_price}}" name="purchase_price" class="form-control" 
                                            placeholder="Purchase Price" step="0.01" min="0">
                                            @if($errors->has('purchase_price'))
                                            <p class="invalid-feedback" >{{ $errors->first('purchase_price') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Status 
                                                <span class="text-danger">*</span></label></label>
                                            <select name="status" class="form-control" >
                                                <option value="">Select Status</option>
                                                <option @if($product->status == 1) selected @endif value="1">Enable</option>
                                                <option @if($product->status == 0) selected @endif  value="0">Disable</option>
                                            </select>
                                            @if($errors->has('status'))
                                                  <p class="invalid-feedback">{{$errors->first('status')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Short Description</label>
                                            <input type="text" value="{{$product->short_description}}" name="short_description" class="form-control" 
                                            placeholder="Description">
                                            @if($errors->has('short_description'))
                                             <p class="invalid-feedback" >{{ $errors->first('short_description') }}</p>
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
                                    <input name="thumbnail" type="file" />
                                    @if($product->thumbnail)
                                         <div class="mt-3" style="border:1px solid;width:100px;height:100px" > 
                                            <img class="w-100" src="{{asset('/uploads/'.$product->thumbnail)}}" 
                                            /> 
                                        </div>
                                    @endif
                                    @if($errors->has('thumbnail'))
                                     <p class="invalid-feedback">{{$errors->first('thumbnail') }}</p>
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
  

    $(document).ready(function() {





    });

</script>
@endsection
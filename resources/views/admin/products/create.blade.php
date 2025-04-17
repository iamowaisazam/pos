@extends('admin.partials.layout')
@section('css')
<style>

    .invalid-feedback{
      display: block;
   }

   .form-group {
    margin-bottom: 10px;
   }


   .ck-editor__editable_inline {
    min-height: 200px;
   }

</style>

@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Create
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
        <form enctype="multipart/form-data" method="post" action="{{URL::to('admin/products')}}">
            @csrf 
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
                                            <input value="{{old('title')}}" name="title" class="form-control" 
                                            placeholder="Title">
                                            @if($errors->has('title'))
                                             <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" >Sku 
                                                <span class="text-danger" >*</span>
                                            </label>
                                            <input value="{{old('sku')}}" name="sku" class="form-control" placeholder="Sku" />
                                            @if($errors->has('sku'))
                                              <p class="invalid-feedback" >{{ $errors->first('sku') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <span class="text-danger" >*</span> Category
                                            </label>
                                            <select name="category_id" class="form-control" >
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                  <option @if(old('category_id') == $item->id) selected @endif value="{{$item->id}}">{{$item->title}}</option>
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
                                                  <option @if(old('unit_id') == $item->id) selected @endif  value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('unit_id'))
                                                  <p class="invalid-feedback">{{$errors->first('unit_id')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Price 
                                                <span class="text-danger" >*</span>
                                            </label>
                                            <input type="number" value="{{old('price')}}" name="price" class="form-control" placeholder="Price" step="0.01" min="0" />
                                            @if($errors->has('price'))
                                            <p class="invalid-feedback" 
                                              >{{ $errors->first('price') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label"> 
                                             <span class="text-danger" >*</span> Purchase Price</label>
                                            <input type="number" value="{{old('purchase_price')}}" name="purchase_price" class="form-control" 
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
                                                <option @if(old('status') == 1) selected @endif value="1">Enable</option>
                                                <option @if(old('status') == 0) selected @endif  value="0">Disable</option>
                                            </select>
                                            @if($errors->has('status'))
                                                  <p class="invalid-feedback">{{$errors->first('status')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Short Description</label>
                                            <input type="text" value="{{old('short_description')}}" name="short_description" class="form-control" 
                                            placeholder="Description" />
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
                                    name="long_description">{{old('long_description')}}</textarea>
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

    
@endsection
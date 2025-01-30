@extends('business.partials.layout')
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
                <li class="breadcrumb-item active">StockAdjustment</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form  enctype="multipart/form-data" method="post" 
            action="{{URL::to('business/stockadjustment')}}/{{Crypt::encryptString($model->id)}}">
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
                                            <label class="form-label">
                                                <span class="text-danger" >*</span> Product
                                            </label>
                                            <select name="product_id" class="form-control" >
                                                <option value="">Select Product</option>
                                                @foreach ($products as $item)
                                                  <option @if($model->product_id == $item->id) selected @endif value="{{$item->id}}">{{$item->sku}} - {{$item->title}} ({{$item->unit->short_name}})   </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('product_id'))
                                              <p class="invalid-feedback">{{$errors->first('product_id') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Quantity 
                                                <span class="text-danger" >*</span>
                                            </label>
                                            <input type="number" value="{{$model->qty}}" name="qty" class="form-control" placeholder="Qty" step="0.01" min="0" />
                                            @if($errors->has('qty'))
                                            <p class="invalid-feedback" 
                                              >{{ $errors->first('qty') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Price 
                                                <span class="text-danger" >*</span>
                                            </label>
                                            <input type="number" value="{{$model->price}}" name="price" class="form-control" placeholder="Price" step="0.01" min="0" />
                                            @if($errors->has('price'))
                                            <p class="invalid-feedback" 
                                              >{{ $errors->first('price') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Date 
                                                <span class="text-danger" >*</span>
                                            </label>
                                            <input type="datetime-local" value="{{$model->date}}" name="date" class="form-control" placeholder="Price" />
                                            @if($errors->has('date'))
                                            <p class="invalid-feedback" 
                                              >{{ $errors->first('date') }}</p>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Type 
                                                <span class="text-danger">*</span></label></label>
                                            <select name="type" class="form-control" >
                                                <option value="">Select Tyoe</option>
                                                <option @if($model->type == 1) selected @endif value="1">Stock In</option>
                                                <option @if($model->type == 0) selected @endif  value="0">Stock Out</option>
                                            </select>
                                            @if($errors->has('type'))
                                                  <p class="invalid-feedback">{{$errors->first('type')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Short Description</label>
                                            <textarea class="form-control" name="description">{{$model->description}}</textarea>
                                            @if($errors->has('description'))
                                             <p class="invalid-feedback" >{{ $errors->first('description') }}</p>
                                            @endif 
                                        </div>
                                    </div>
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
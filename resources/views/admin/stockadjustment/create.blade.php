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
                <li class="breadcrumb-item active">StockAdjustment</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form enctype="multipart/form-data" method="post" action="{{URL::to('admin/stockadjustment')}}">
            @csrf 
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
                                                  <option @if(old('product_id') == $item->id) selected @endif value="{{$item->id}}">{{$item->sku}} - {{$item->title}} ({{$item->unit->short_name}})   </option>
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
                                            <input type="number" value="{{old('qty')}}" name="qty" class="form-control" placeholder="Qty" step="0.01" min="0" />
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
                                            <input type="number" value="{{old('price')}}" name="price" class="form-control" placeholder="Price" step="0.01" min="0" />
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
                                            <input type="datetime-local" value="{{old('date')}}" name="date" class="form-control" placeholder="Price" />
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
                                                <option @if(old('type') == 'stock_in') selected @endif value="1">Stock In</option>
                                                <option @if(old('type') == 'stock_out') selected @endif  value="0">Stock Out</option>
                                            </select>
                                            @if($errors->has('type'))
                                                  <p class="invalid-feedback">{{$errors->first('type')}}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Short Description</label>
                                            <textarea class="form-control" name="description">{{old('description')}}</textarea>
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

    
@endsection
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
        <h4 class="text-themecolor">Edit
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Sale Payments</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <form method="post" action="{{URL::to('admin/salepayments/'.Crypt::encryptString($model->id))}}" >
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white">Edit Sale Payment</h4>
                        </header>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group ">
                                        <label class="form-label">Date <span class="text-danger" >*</span> </label>
                                        <input type="datetime-local" value="{{$model->date}}"
                                        name="date" class="form-control" placeholder="Date" />
                                        @if($errors->has('date'))
                                        <p class="text-danger" >{{ $errors->first('date') }}</p>
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Customer</label>
                                        <select class="form-control" name="customer">
                                            <option value="" >Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option @if($model->customer_id == $customer->id) selected @endif value="{{$customer->id}}"
                                                  >{{$customer->customer_name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('customer'))
                                         <p class="text-danger" >{{ $errors->first('customer') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <select class="form-control" name="type">
                                            <option>Select Type</option>
                                            <option @if($model->credit == 0) selected @endif value="debit">Debit</option>
                                            <option @if($model->debit == 0) selected @endif value="credit">Credit</option>
                                        </select>
                                        @if($errors->has('type'))
                                         <p class="text-danger" >{{ $errors->first('type') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Amount</label>
                                        <input value="{{$model->debit ? $model->debit : $model->credit }}" name="amount" class="form-control" placeholder="Amount">
                                        @if($errors->has('amount'))
                                        <p class="text-danger" >{{ $errors->first('amount') }}</p>
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <input  name="description" class="form-control" placeholder="Description" value="{{$model->description}}" />
                                        @if($errors->has('description'))
                                        <p class="text-danger" >{{ $errors->first('description') }}</p>
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Addiontal Details</label>
                                        <textarea name="details" class="form-control">{{$model->details}}</textarea>
                                        @if($errors->has('details'))
                                        <p class="text-danger" >{{ $errors->first('details') }}</p>
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
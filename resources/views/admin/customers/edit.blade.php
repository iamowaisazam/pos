@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"> @if(isset($customer)) Edit Customer @else Create Customer @endif
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
        </div>
    </div>
</div>

<form method="post"  
@if(isset($customer))
action="{{URL::to('admin/customers')}}/{{Crypt::encryptString($customer->id)}}" 
@else
action="{{URL::to('admin/customers')}}/create" 
@endif>

@csrf
@method('PUT')



<div class="row">


    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Personal Info</h4>
            </header>
            <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" >Company Name</label>
                                <input type="text" 
                                @if(isset($customer))
                                value="{{$customer->company_name}}"
                                @else
                                 value="{{old('company_name')}}"
                                @endif
                                name="company_name" class="form-control" 
                                placeholder="Company Name">
                                @if($errors->has('company_name'))
                                 <p class="text-danger" >{{ $errors->first('company_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">FullName</label>
                                <input type="text" 
                                @if(isset($customer))
                                value="{{$customer->customer_name}}"
                                @else
                                 value="{{old('customer_name')}}"
                                @endif
                                name="customer_name" class="form-control" 
                                placeholder="Customer Name">
                                @if($errors->has('customer_name'))
                                 <p class="text-danger" >{{ $errors->first('customer_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Contact</label>
                                <input type="text" 
                                @if(isset($customer))
                                value="{{$customer->customer_phone}}"
                                @else
                                 value="{{old('customer_phone')}}"
                                @endif
                                name="customer_phone" class="form-control" placeholder="Customer Contact">
                                @if($errors->has('customer_phone'))
                                 <p class="text-danger" >{{ $errors->first('customer_phone') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text"
                                @if(isset($customer))
                                value="{{$customer->customer_email}}"
                                @else
                                 value="{{old('customer_email')}}"
                                @endif 
                                name="customer_email" class="form-control" placeholder="Customer Email">
                                @if($errors->has('customer_email'))
                                 <p class="text-danger" >{{ $errors->first('customer_email') }}</p>
                                @endif 
                            </div>
                        </div>
                     </div>
                </div>  
        </section>
   </div>

   <div class="col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
            <h4 class="mb-0 text-white" >Address Info</h4>
        </header>
        <div class="card-body"> 
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" 
                        @if(isset($customer))
                        value="{{$customer->country}}"
                        @else
                         value="{{old('country')}}"
                        @endif
                        name="country" class="form-control" 
                        placeholder="Country">
                        @if($errors->has('country'))
                         <p class="text-danger" >{{ $errors->first('country') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">State / Province</label>
                        <input type="text" 
                        @if(isset($customer))
                        value="{{$customer->state}}"
                        @else
                         value="{{old('state')}}"
                        @endif
                        name="state" class="form-control" 
                        placeholder="State / Province">
                        @if($errors->has('state'))
                         <p class="text-danger" >{{ $errors->first('state') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" 
                        @if(isset($customer))
                        value="{{$customer->city}}"
                        @else
                         value="{{old('city')}}"
                        @endif
                        name="city" class="form-control" placeholder="City">
                        @if($errors->has('city'))
                         <p class="text-danger" >{{ $errors->first('city') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" >Postal Code</label>
                        <input type="text"
                        @if(isset($customer))
                        value="{{$customer->postal_code}}"
                        @else
                         value="{{old('postal_code')}}"
                        @endif 
                        name="postal_code" class="form-control" placeholder="Postal Code">
                        @if($errors->has('postal_code'))
                         <p class="text-danger" >{{ $errors->first('postal_code') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="form-group">
                        <label class="form-label" >Street Address</label>
                        <input type="text"
                        @if(isset($customer))
                        value="{{$customer->street_address}}"
                        @else
                         value="{{old('street_address')}}"
                        @endif 
                        name="street_address" class="form-control" placeholder="Street Address">
                        @if($errors->has('street_address'))
                         <p class="text-danger" >{{ $errors->first('street_address') }}</p>
                        @endif 
                    </div>
                </div>

            </div>
        </div>
    </section>
   </div>

   <div class="col-md-12 text-center pb-3">
    <button class="btn btn-primary"  type="submit">Submit</button>
   </div>

 </div>
</form>

@endsection
@section('js')
    
<script>
    $(document).ready(function() {
       
    });
</script>

@endsection
@extends('business.partials.layout')
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
        <h4 class="text-themecolor">Create</h4>
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

<form method="post" action="{{URL::to('business/customers')}}">
@csrf


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
                            <input type="text" value="{{old('company_name')}}" name="company_name" class="form-control" placeholder="Company Name">
                            @if($errors->has('company_name'))
                                <p class="text-danger" >{{ $errors->first('company_name') }}</p>
                            @endif 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">FullName <span class="text-danger" >*</span></label>
                            <input type="text" value="{{old('name')}}"
                            name="name" class="form-control" 
                            placeholder="Name">
                            @if($errors->has('name'))
                                <p class="text-danger" >{{ $errors->first('name') }}</p>
                            @endif 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Contact</label>
                            <input type="text" value="{{old('phone')}}" name="phone" class="form-control" placeholder="Contact" />
                            @if($errors->has('phone'))
                                <p class="text-danger" >{{ $errors->first('phone') }}</p>
                            @endif 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="text" value="{{old('email')}}"
                            name="email" class="form-control" placeholder="Email">
                            @if($errors->has('email'))
                                <p class="text-danger" >{{ $errors->first('email') }}</p>
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
                        <input type="text" value="{{old('country')}}" name="country" class="form-control"  placeholder="Country" />
                        @if($errors->has('country'))
                         <p class="text-danger" >{{ $errors->first('country') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">State / Province</label>
                        <input type="text" value="{{old('state')}}" name="state" class="form-control"  placeholder="State / Province" />
                        @if($errors->has('state'))
                         <p class="text-danger" >{{ $errors->first('state') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" value="{{old('city')}}" name="city" class="form-control" placeholder="City" />
                        @if($errors->has('city'))
                         <p class="text-danger" >{{ $errors->first('city') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label" >Postal Code</label>
                        <input type="text" value="{{old('postal_code')}}" name="postal_code" class="form-control" placeholder="Postal Code" />
                        @if($errors->has('postal_code'))
                         <p class="text-danger" >{{ $errors->first('postal_code') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="form-group">
                        <label class="form-label" >Street Address</label>
                        <input type="text" value="{{old('street_address')}}"
                        name="street_address" class="form-control" placeholder="Street Address" />
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
    


@endsection
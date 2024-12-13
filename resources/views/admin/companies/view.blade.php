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
        <h4 class="text-themecolor"> View
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Company</li>
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
                <h4 class="mb-0 text-white">Account Info</h4>
            </header>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">UserName</label>
                                <input readonly value="{{$user->name}}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input readonly value="{{$user->email}}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Joined Date</label>
                                <input readonly value="{{$user->created_at}}" class="form-control" />
                            </div>
                        </div>
                   </div>
                </div>  
        </section>
   </div>


   <div class="col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
            <h4 class="mb-0 text-white">Company Info</h4>
        </header>
        <div class="card-body"> 
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Company Name</label>
                        <input readonly value="{{$user->company->name}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input readonly value="{{$user->company->email}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Contact</label>
                        <input readonly value="{{$user->company->contact}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input readonly value="{{$user->company->country}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">State</label>
                        <input readonly value="{{$user->company->state}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input readonly value="{{$user->company->city}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Postal Code</label>
                        <input readonly value="{{$user->company->postal_code}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Street Address</label>
                        <input readonly value="{{$user->company->street_address}}" class="form-control" />
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">Details</label>
                        <input readonly value="{{$user->company->details}}" class="form-control" />
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
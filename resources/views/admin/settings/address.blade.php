@extends('admin.partials.layout')
@section('css')
 
<link href="{{asset('admin/assets/summernote/summernote-bs4.css')}}" rel="stylesheet">
<style>
    .error{
        color:red;
    }
</style>

@endsection
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Address</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="card">            
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Address</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/admin/settings/address') }}">
                    @csrf                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <input type="text" value="{{$company->country}}" name="country" class="form-control" placeholder="Country">
                                @if($errors->has('country'))
                                 <p class="text-danger" >{{ $errors->first('country') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">State / Province</label>
                                <input type="text" value="{{$company->state}}" name="state" class="form-control" placeholder="State / Province">
                                @if($errors->has('state'))
                                 <p class="text-danger" >{{ $errors->first('state') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" value="{{ $company->city}}" name="city" class="form-control" placeholder="City">
                                @if($errors->has('city'))
                                 <p class="text-danger" >{{ $errors->first('city') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" >Postal Code</label>
                                <input type="text" value="{{$company->postal_code}}" name="postal_code" class="form-control" />
                                @if($errors->has('postal_code'))
                                 <p class="text-danger" >{{ $errors->first('postal_code') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="form-label" >Street Address</label>
                                <input type="text" value="{{$company->street_address}}" name="street_address" class="form-control" placeholder="Street Address">
                                @if($errors->has('street_address'))
                                 <p class="text-danger" >{{ $errors->first('street_address') }}</p>
                                @endif 
                            </div>
                        </div> 
                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>       
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('admin/js/jquery.tagsinput.js')}}"></script>
<script src="{{asset('admin/assets/summernote/summernote-bs4.min.js')}}"></script>
<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
        $(".tagsinput").tagsInput();

    });

</script>
    
@endsection
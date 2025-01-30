@extends('business.partials.layout')
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
        <h4 class="text-themecolor">General</h4>
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
                <h4 class="mb-0 text-white">General Settings</h4>
            </header>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ url('/business/settings/general') }}">
                    @csrf                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" value="{{$business->name}}" class="form-control" name="name" />
                            </div>
                        </div>   
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Icon (40 X 40)</label>
                                <input type="file" value="{{$business->icon}}" class="form-control" name="icon" />
                                @if($business->icon)
                                <img src="{{asset('/uploads/'.$business->icon)}}" style="border:1px solid;width:100px;height:100px"  />
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Logo (108 X 21)</label>
                                <input type="file" value="{{$business->logo}}" class="form-control" name="logo" />

                                @if($business->logo)
                                <img src="{{asset('/uploads/'.$business->logo)}}" style="border:1px solid; width:100px;height:100px"  />
                                @endif
                            </div>
                        </div> 

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Email</label>
                                <input type="text" value="{{$business->email}}" class="form-control" name="email" />
                            </div>
                        </div> 

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="{{$business->contact}}" class="form-control" name="contact" />
                            </div>
                        </div>  

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" value="{{$business->website}}" class="form-control" name="website" />
                            </div>
                        </div> 

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Business Details</label>
                                <textarea name="details" class="form-control" rows="5">{{$business->details}}</textarea>
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
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
        <h4 class="text-themecolor">Theme Settings</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Theme Settings</li>
            </ol>
        </div>
    </div>
</div>

<form method="post" enctype="multipart/form-data" action="{{URL::to('admin/settings/theme')}}" >
  @csrf

<div class="row">
    <div class="col-lg-12">
        <section class="card">            
            <header class="card-header bg-info">
                <h4 class="mb-0 ">Theme Settings</h4>
                </header>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Primary Color</label>
                                <input class="form-control" type="color"
                                  value="{{$settings['primary_color']}}"   
                                  name="primary_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Contrast Color</label>
                                <input class="form-control" type="color"
                                  value="{{$settings['contrast_color']}}"   
                                  name="contrast_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Secondry Color</label>
                                <input class="form-control" type="color"
                                  value="{{$settings['secondry_color']}}"   
                                  name="secondry_color" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
              </div>
          </section>
        </div>

        <div class="col-lg-12">
            <section class="card">            
                <header class="card-header bg-info">
                    <h4 class="mb-0 ">Navigation Settings </h4>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Topbar Background Color</label>
                                <input class="form-control" type="color"
                                    value="{{$settings['topbar_background_color']}}"   
                                    name="topbar_background_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Topbar Text Color</label>
                                <input class="form-control" type="color"
                                    value="{{$settings['topbar_text_color']}}"   
                                    name="topbar_text_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Sidebar Background Color</label>
                                <input class="form-control" type="color"
                                    value="{{$settings['sidebar_background_color']}}"   
                                    name="sidebar_background_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Sidebar Text Color</label>
                                <input class="form-control" type="color"
                                    value="{{$settings['sidebar_text_color']}}"   
                                    name="sidebar_text_color" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="py-2">Sidebar Active Color</label>
                                <input class="form-control" type="color"
                                    value="{{$settings['sidebar_active_color']}}"   
                                    name="sidebar_active_color" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center pt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                     </div>
                  </div>
              </section>
            </div>
    </div>
</form>   
@endsection
@section('js')

    
@endsection
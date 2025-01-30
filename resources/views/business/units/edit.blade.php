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
                <li class="breadcrumb-item active">Units</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form enctype="multipart/form-data" method="post" action="{{URL::to('business/units')}}/{{Crypt::encryptString($model->id)}}">
            @csrf
            @method('put')
 
            <div class="row">
                <div class="col-md-12">

                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white">Edit Unit</h4>
                        </header>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" >Title <span class="text-danger" >*</span> </label>
                                        <input  type="text" value="{{$model->title}}" name="title" class="form-control" 
                                        placeholder="Title">
                                        @if($errors->has('title'))
                                         <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" >Short Name <span class="text-danger" >*</span> </label>
                                        <input  type="text" value="{{$model->short_name}}" name="short_name" class="form-control" placeholder="Short Name">
                                        @if($errors->has('short_name'))
                                         <p class="invalid-feedback" >{{ $errors->first('short_name') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" >Status <span class="text-danger" >*</span> </label>
                                        <select class="form-control" name="status">
                                            <option @if($model->status == 1) selected @endif value="1">Enable</option>
                                            <option @if($model->status == 0) selected @endif value="0">Disable</option>
                                        </select>
                                        @if($errors->has('status'))
                                         <p class="invalid-feedback" >{{ $errors->first('status') }}</p>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" >Image</label>
                                        <input type="file" value="" class="form-control" name="thumbnail" />
                                        @if($errors->has('thumbnail'))
                                         <p class="invalid-feedback" >{{ $errors->first('thumbnail') }}</p>
                                        @endif
                                        
                                        @if($model->thumbnail)
                                        <img src="{{asset('/uploads/'.$model->thumbnail)}}" style="border:1px solid;width:100px;height:100px"  />
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" >Description</label>
                                        <input type="text" value="{{$model->description}}" name="description" 
                                        class="form-control" placeholder="Description">
                                        @if($errors->has('description'))
                                         <p class="invalid-feedback" >{{ $errors->first('description') }}</p>
                                        @endif 
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
   


</script>
@endsection
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
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <form enctype="multipart/form-data" method="post" action="{{URL::to('admin/categories')}}" >
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <section class="card">
                        <header class="card-header bg-info">
                            <h4 class="mb-0 text-white">Create Category</h4>
                        </header>
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" >Title <span class="text-danger" >*</span> </label>
                                            <input  type="text" value="{{old('title')}}" name="title" class="form-control" 
                                            placeholder="Title">
                                            @if($errors->has('title'))
                                             <p class="invalid-feedback" >{{ $errors->first('title') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" >Status <span class="text-danger" >*</span> </label>
                                            <select class="form-control" name="status">
                                                <option @if(old('status') == 1) selected @endif value="1">Enable</option>
                                                <option @if(old('status') == 0) selected @endif value="0">Disable</option>
                                            </select>
                                            @if($errors->has('status'))
                                             <p class="invalid-feedback" >{{ $errors->first('status') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" >Image</label>
                                            <input type="file" value="" class="form-control" name="thumbnail" />
                                            @if($errors->has('thumbnail'))
                                             <p class="invalid-feedback" >{{ $errors->first('thumbnail') }}</p>
                                            @endif 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description</label>
                                            <input type="text" value="{{old('description')}}" name="description" 
                                            class="form-control" placeholder="Description">
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
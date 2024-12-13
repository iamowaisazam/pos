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
        <h4 class="text-themecolor">Create Role
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Create Role Form</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/roles/store')}}" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" >Name</label>
                        <input type="text" value="{{old('name')}}" name="name" class="form-control" 
                        placeholder="Name">
                        @if($errors->has('name'))
                         <p class="invalid-feedback" >{{ $errors->first('name') }}</p>
                        @endif 
                    </div>

                    @foreach ($permissions->groupBy('grouping') as $group => $permissions)

                    <h3 class="box-title m-t-40 heading-style">{{$group}} &amp; Permission</h3>
                    <hr>
                    <div class="row">
                        @foreach ($permissions  as $permission)
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-check mr-sm-2">
                                        <input type="checkbox" 
                                          class="form-check-input" 
                                          id="{{$permission->slug}}" 
                                          name="permissions[]" 
                                          value="{{$permission->slug}}">
                                        <label class="form-check-label" for="{{$permission->slug}}">{{ucfirst($permission->name)}}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                        
                    @endforeach
                                
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                     </div>

                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
    
@endsection
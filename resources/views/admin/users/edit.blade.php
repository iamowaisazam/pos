@extends('admin.partials.layout')
@section('css')
    
<style>

    .error{
        color:red;
    }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit User
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Edit User</h4>
            </header>
            <div class="card-body">
                <form method="post" action="{{URL::to('admin/users/update/'.Crypt::encryptString($user->id))}}" >
                    @csrf
                    <div class="form-group">
                        <label class="form-label" >User Name</label>
                        <input type="text" value="{{$user->name}}" name="name" class="form-control" 
                        placeholder="User Name">
                        @if($errors->has('name'))
                         <p class="invalid-feedback" >{{ $errors->first('name') }}</p>
                        @endif 
                    </div>
                    
                    <div class="form-group">
                      <label class="form-label">Email Address</label>
                      <input type="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email Address"> 
                      @if($errors->has('email'))
                      <p class="invalid-feedback" >{{ $errors->first('email') }}</p>
                     @endif 
                   </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" value="" class="form-control" placeholder="Password">
                        <small  class="form-text text-dark">Please never share your email & password with anyone else.</small>

                        @if($errors->has('password'))
                          <p class="invalid-feedback" >{{ $errors->first('password') }}</p>
                         @endif 
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Select Role</label>
                        <select name="role" class="form-control" >
                            <option value="">Select Role</option>
                            @foreach ($roles as $item)
                            <option @if($user->role_id == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role'))
                         <p class="invalid-feedback" >{{ $errors->first('role') }}</p>
                        @endif 
                    </div>

                    @if(Auth::user()->permission('users.edit'))
                    <div class="form-group row">
                        <div class="col-md-12 text-left">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                     </div>
                     @endif 
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
    
@endsection
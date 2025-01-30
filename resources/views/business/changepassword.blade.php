@extends('business.partials.layout')
@section('css')
    <style>
        .error{
            color:red;
        }
    </style>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header"> Edit User And Assign The Permission </header>
            <div class="card-body">
                <form method="post" 
                action="{{URL::to('admin/changepassword_submit')}}" >
                    @csrf
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" value="{{Auth::user()->name}}" name="name" class="form-control" 
                        placeholder="User Name">
                        @if($errors->has('name'))
                         <p class="error" >{{ $errors->first('name') }}</p>
                        @endif 
                    </div>
                    
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control" placeholder="Email Address"> 
                      @if($errors->has('email'))
                      <p class="error" >{{ $errors->first('email') }}</p>
                     @endif 
                   </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="" class="form-control" placeholder="Password">
                        <small  class="form-text text-dark">Please never share your email & password with anyone else.</small>
                        @if($errors->has('password'))
                          <p class="error" >{{ $errors->first('password') }}</p>
                         @endif 
                    </div>

                    <div class="form-group text-center pt-5">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
@section('js')
    
@endsection
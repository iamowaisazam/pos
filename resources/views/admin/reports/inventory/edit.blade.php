@extends('admin.layout')
@section('css')


<style>
    
    table td{
        /* border: 1px solid lightgray; */
    }

    table th{
        /* border: 1px solid lightgray; */
    }

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
           
            overflow: scroll!important;
        }
    }
    

    .dataTables_filter{
        display: none!important;
    }


</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">(#{{$data->id}}) Order Detail
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
        </div>
    </div>

    <form action="{{URL::to('admin/orders/update',$data->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 col-lg-9">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="m-b-0 text-white">Customer Details</h5>
                    </div>
                    <div class="card-body">

                    
              
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Customer Name</label>
                                <input type="text" value="{{$data->customer_name}}" name="customer_name" class="form-control" 
                                placeholder="Customer Name">
                                @if($errors->has('customer_name'))
                                <p class="invalid-feedback" >{{ $errors->first('customer_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Customer Phone</label>
                                <input type="text" value="{{$data->customer_phone}}" name="customer_phone" class="form-control" 
                                placeholder="Customer Phone">
                                @if($errors->has('customer_name'))
                                <p class="invalid-feedback" >{{ $errors->first('customer_name') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Customer Email</label>
                                <input type="text" value="{{$data->customer_email}}" name="customer_email" class="form-control" 
                                placeholder="Customer Email">
                                @if($errors->has('customer_email'))
                                <p class="invalid-feedback" >{{ $errors->first('customer_email') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <input type="text" value="{{$data->country}}" name="country" class="form-control" 
                                placeholder="Country">
                                @if($errors->has('country'))
                                <p class="invalid-feedback" >{{ $errors->first('country') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <input type="text" value="{{$data->city}}" name="city" class="form-control" 
                                placeholder="City">
                                @if($errors->has('city'))
                                <p class="invalid-feedback" >{{ $errors->first('city') }}</p>
                                @endif 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Street Address</label>
                                <input type="text" value="{{$data->address}}" name="address" class="form-control" 
                                placeholder="Address">
                                @if($errors->has('address'))
                                <p class="invalid-feedback" >{{ $errors->first('address') }}</p>
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">Your Cart ({{count($data->children)}} items)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table product-overview">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product info</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th style="text-align:center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->children as $item)
                                <tr>
                                    <td width="150">
                                        <img src="{{asset($item->image_id)}}" width="80">
                                    </td>
                                    <td width="550">
                                        <h5 class="font-500">{{$item->title}} ({{$item->sku}})</h5>
                                    </td>
                                    <td >PKR {{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td width="150" align="center" class="font-500">PKR {{$item->total}}</td>                            
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" class="text-end" >Grand Total</th>
                                    <td width="150" align="center" class="font-500">
                                        PKR {{$data->grandtotal}}</td>                            
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Column -->
        <div class="col-md-12 col-lg-3">
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">Status</h5>
                </div>
                <div class="card-body">
                    
                    <div class="form-group">
                        <label class="form-label" >Tracking Id</label>
                        <input type="text" value="{{$data->tracking_id}}" 
                            name="tracking_id" 
                            class="form-control" 
                            placeholder="Tracking Id">
                            @if($errors->has('tracking_id'))
                            <p class="invalid-feedback" >{{ $errors->first('tracking_id') }}</p>
                            @endif 
                    </div>

                    <div class="form-group">
                        <label class="form-label" >Order Status</label>
                            <select class="form-control" name="order_status" >
                            
                            </select>
                            @if($errors->has('order_status'))
                            <p class="invalid-feedback" >{{ $errors->first('order_status') }}</p>
                            @endif 
                    </div>

                    <div class="form-group">
                        <label class="form-label" >Payment Method</label>
                            <select class="form-control" name="payment_method" >
                                <option {{$data->payment_method == 'cash_on_delivery' ? 'selected' : ''}} value="cash_on_delivery">Cash On Delivery</option>
                            </select>
                            @if($errors->has('payment_method'))
                            <p class="invalid-feedback" >{{ $errors->first('payment_method') }}</p>
                            @endif 
                    </div>

                    <div class="form-group">
                        <label class="form-label" >Payment Status</label>
                            <select class="form-control" name="payment_status" >
                                <option {{$data->payment_status == 'paid' ? 'selected' : ''}} value="paid">Paid</option>
                                <option {{$data->payment_status == 'unpaid' ? 'selected' : ''}} value="unpaid">Unpaid</option>
                            </select>
                            @if($errors->has('payment_method'))
                            <p class="invalid-feedback" >{{ $errors->first('payment_method') }}</p>
                            @endif 
                    </div>                
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">ORDER NOTES</h5>
                </div>
                <div class="card-body">
                    <textarea class="form-control" name="order_notes">{{$data->order_notes}}</textarea>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="m-b-0 text-white">Invoice</h5>
                </div>
                <div class="card-body text-center">
                    <a class="btn btn-success" href="{{URL::to('/get_invoice/'.$data->id)}}" target="_blank">
                    Download</a>
                </div>
            </div>
            
         </div>
      </div>

      <div class="row">
        <div class="col-md-12 text-center my-3">
            <button class="btn btn-primary" type="submit" >Update</button>
        </div>
      </div>


    </form>
 </div>
@endsection
 @section('js')
        

       <script>
        $(function () {
     

         });
    </script>
@endsection
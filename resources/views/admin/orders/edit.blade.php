@extends('admin.partials.layout')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">

<style>
    .invalid-feedback{
      display: block;
   }

   .product{    
     width: 100%;
     margin-right: 6px;
   }

   .select2-container {
    margin-right: 7px;
   }

   .select2-selection__rendered {
    line-height: 31px!important;
    }

   .select2-container .select2-selection--single{
    height: 35px!important;
    width: 100%;
    margin-right: 6px;
    

   }

</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"> @if(isset($order)) Edit Order @else Create Order @endif
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

<form method="post"  
    @if(isset($customer))
    action="{{URL::to('admin/orders')}}/{{Crypt::encryptString($customer->id)}}" 
    @else
    action="{{URL::to('admin/orders')}}/create" 
    @endif>
@csrf
@method('PUT')

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Order Info</h4>
            </header>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="datetime-local"
                                @if(isset($order))
                                value="{{$order->date}}"
                                @else
                                 value="{{old('date')}}"
                                @endif
                                name="date" class="form-control" 
                                placeholder="Date" />
                                @if($errors->has('date'))
                                 <p class="text-danger" >{{ $errors->first('date') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Ref No</label>
                                <input 
                                @if(isset($order))
                                value="{{$order->ref}}"
                                @else
                                 value="{{old('ref')}}"
                                @endif
                                name="ref" class="form-control" 
                                placeholder="Ref No">
                                @if($errors->has('ref'))
                                 <p class="text-danger" >{{ $errors->first('ref') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Tracking No</label>
                                <input 
                                readonly
                                @if(isset($order))
                                value="{{$order->tracking_id}}"
                                @else
                                 value="{{old('tracking_id')}}"
                                @endif
                                name="tracking_id" class="form-control" 
                                placeholder="Tracking No">
                                @if($errors->has('tracking_id'))
                                 <p class="text-danger" >{{ $errors->first('tracking_id') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Is Paid</label>
                                <select name="is_paid" class="form-control" >
                                    <option value="0">No</option>
                                    <option @if(isset($order) && $order->is_paid == 1 ) selected @endif
                                     value="1">Yes</option>
                                </select>
                                @if($errors->has('is_paid'))
                                 <p class="text-danger" >{{ $errors->first('is_paid') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <input 
                                @if(isset($order))
                                value="{{$order->description}}"
                                @else
                                 value="{{old('description')}}"
                                @endif
                                name="description" class="form-control" 
                                placeholder="Description">
                                @if($errors->has('description'))
                                 <p class="text-danger" >{{ $errors->first('description') }}</p>
                                @endif 
                            </div>
                        </div>
                     </div>
                </div>  
        </section>
   </div>

   <div class="col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
            <h4 class="mb-0 text-white" >Customer Info</h4>
        </header>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer</label>
                            <select class="form-control" name="customer">
                                <option>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option 
                                      @if(isset($order) && $customer->id == $order->customer_id)
                                      selected
                                      @endif
                                      data-name="{{$customer->customer_name}}"
                                      data-email="{{$customer->customer_email}}"
                                      data-contact="{{$customer->customer_phone}}"
                                      data-country="{{$customer->country}}"
                                      data-state="{{$customer->state}}"
                                      data-city="{{$customer->city}}"
                                      data-postalcode="{{$customer->postal_code}}"
                                      data-address="{{$customer->street_address}}" 
                                      value="{{$customer->id}}"
                                      >{{$customer->customer_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer'))
                             <p class="text-danger" >{{ $errors->first('customer') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Name</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_name}}"
                            @else
                             value="{{old('customer_name')}}"
                            @endif
                            name="customer_name" class="form-control" 
                            placeholder="Customer Name">
                            @if($errors->has('customer_name'))
                             <p class="text-danger" >{{ $errors->first('customer_name') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Email</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_email}}"
                            @else
                             value="{{old('customer_email')}}"
                            @endif
                            name="customer_email" class="form-control" 
                            placeholder="Customer Email">
                            @if($errors->has('customer_email'))
                             <p class="text-danger" >{{ $errors->first('customer_email') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Contact</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_contact}}"
                            @else
                             value="{{old('customer_contact')}}"
                            @endif
                            name="customer_contact" class="form-control" 
                            placeholder="Customer Contact">
                            @if($errors->has('customer_contact'))
                             <p class="text-danger" >{{ $errors->first('customer_contact') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Country</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_country}}"
                            @else
                             value="{{old('customer_country')}}"
                            @endif
                            name="customer_country" class="form-control" 
                            placeholder="Customer Country">
                            @if($errors->has('customer_country'))
                             <p class="text-danger" >{{ $errors->first('customer_country') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer State</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_state}}"
                            @else
                             value="{{old('customer_state')}}"
                            @endif
                            name="customer_state" class="form-control" 
                            placeholder="Customer State">
                            @if($errors->has('customer_state'))
                             <p class="text-danger" >{{ $errors->first('customer_state') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer City</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_city}}"
                            @else
                             value="{{old('customer_city')}}"
                            @endif
                            name="customer_city" class="form-control" 
                            placeholder="Customer City">
                            @if($errors->has('customer_city'))
                             <p class="text-danger" >{{ $errors->first('customer_city') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Postal Code</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_postalcode}}"
                            @else
                             value="{{old('customer_postalcode')}}"
                            @endif
                            name="customer_postalcode" class="form-control" 
                            placeholder="Customer Postal Code">
                            @if($errors->has('customer_postalcode'))
                             <p class="text-danger" >{{ $errors->first('customer_postalcode') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Customer Address</label>
                            <input 
                            @if(isset($order))
                            value="{{$order->customer_address}}"
                            @else
                             value="{{old('customer_address')}}"
                            @endif
                            name="customer_address" class="form-control" 
                            placeholder="Customer Address">
                            @if($errors->has('customer_address'))
                             <p class="text-danger" >{{ $errors->first('customer_address') }}</p>
                            @endif 
                        </div>
                    </div>
                 </div>
            </div>  
       </section>
   </div>

   <div class="col-lg-12 items-sections">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Order Items</h4>
            </header>
            <div class="card-body"> 
                <div class="row">
                    <div class="m-auto col-md-6 text-center  d-flex">
                        <select class="product">
                            <option value="">Select Item</option>
                            @foreach ($products as $p)
                            <option data-id="{{$p->id}}" data-price="{{$p->price}}" value="{{$p->id}}">{{$p->title}}</option>  
                            @endforeach
                        </select>
                        <button class="btn btn-success add" type="button" >+</button>
                    </div>
               </div>

               <hr>

               <div class="items">
               </div>
               
               <hr>

               <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                            <div class="mb-3 row">
                                <div class="col-md-6 text-end align-self-center">
                                    <label class="form-label" >Subtotal :</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <input readonly name="subtotal" @if(isset($order)) value="{{$order->subtotal}}" @endif type="text" class="subtotal form-control" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6 text-end align-self-center">
                                    <label class="form-label">Discount :</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <input type="number" @if(isset($order)) value="{{$order->discount}}" @endif name="discount" step="0.01" class="discount form-control" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-6 text-end align-self-center">
                                    <label class="form-label">Tax :</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <input type="number" @if(isset($order)) value="{{$order->tax}}" @endif name="tax" step="0.01"  class="tax form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-end align-self-center">
                                    <label class="form-label" >Grand Total :</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <input readonly name="total" @if(isset($order)) value="{{$order->total}}"@endif type="text" 
                                    class="grandtotal form-control" />
                                </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    
<script>
    $(document).ready(function() {

        $('.product').select2({
            placeholder: "Select Item..",
            allowClear: true
        });

        let existingItems = @json(isset($order) ? $order->items : []);
      
        if(existingItems.length > 0){
         existingItems = JSON.parse(existingItems);
        }
        let itemssections = $('.items-sections');

        function calculateTotals() {
            
            let subtotal = 0;
            let discount = parseFloat($('.discount').val()) || 0;
            let tax = parseFloat($('.tax').val()) || 0;
            let grandtotal = 0;

            $('.items .row').each(function () {
                const price = parseFloat($(this).find('.price').val()) || 0;
                const quantity = parseFloat($(this).find('.quantity').val()) || 0; 
                const total = price * quantity;
                $(this).find('.total').val(total.toFixed(2));
                subtotal +=  total;
            });

            grandtotal += subtotal;
            grandtotal += -discount;
            grandtotal += tax;

            $('.subtotal').val(subtotal);
            $('.grandtotal').val(grandtotal);
        }


        function rendeItems(item) {

            let uid = Date.now() + Math.floor(Math.random() * 1000);

            let template = `<div class="row py-2">
                <div class="col-md-5">
                    <label class="form-label">Item Name</label>
                    <input class="form-control" name="items[${uid}][item]" value="${item.item}" />
                </div>
                <div class="col-md-2">
                    <label class="form-label">Price</label>
                    <input class="form-control price" type="number" name="items[${uid}][price]" min="1" step="0.01" value="${item.price}" />
                </div>
                <div class="col-md-2">
                    <label class="form-label" >Quantity</label>
                    <input class="form-control quantity" type="number" min="1" step="0.01"  name="items[${uid}][quantity]" value="${item.quantity}" />
                </div>
                <div class="col-md-3">
                    <label class="form-label" >Total</label>
                    <div class="d-flex">
                        <input value="${item.total}" readonly type="number" class="form-control total" name="items[${uid}][total]" />
                        <button class="btn btn-danger remove" type="button" >X</button>
                    </div>
                </div>
            </div> `;

            return template;
        }

        
        function loadExisting(){

            for (const element in existingItems) {
                    let html = rendeItems({
                        item: existingItems[element].item,
                        price: existingItems[element].price,
                        quantity: existingItems[element].quantity,
                        total: existingItems[element].total,
                    });
                $('.items').append(html);
            }

        }


        itemssections.on('click','.add',function(){

            let p = $('.product option:selected');
            if(p.val() == ""){
                alert('Please Select Product');
                return false;
            }

            let html = rendeItems({
                item:p.text(),
                price:p.data('price'),
                quantity:0,
                total:0,
            });
            $('.items').append(html);
            calculateTotals();
            
            $('.product').val(null).trigger('change');
        });
   

        $('.items').on('click', '.remove', function () {
            $(this).parent().parent().parent().remove();
            calculateTotals();
        });

        $('select[name=customer]').change(function (e) { 
            $('input[name=customer_name]').val($(this).find('option:selected').data('name'));
            $('input[name=customer_email]').val($(this).find('option:selected').data('email'));
            $('input[name=customer_contact]').val($(this).find('option:selected').data('contact'));
            $('input[name=customer_country]').val($(this).find('option:selected').data('country'));
            $('input[name=customer_state]').val($(this).find('option:selected').data('state'));
            $('input[name=customer_city]').val($(this).find('option:selected').data('city'));
            $('input[name=customer_postalcode]').val($(this).find('option:selected').data('postalcode'));
            $('input[name=customer_address]').val($(this).find('option:selected').data('address'));
        });

        $('.items-sections').on('change','.price, .quantity, .discount, .tax', function () {
           calculateTotals();
        });



        // 
        // Onload Method
        // 
        function OnLoad(){

            loadExisting();
            calculateTotals();

            

        }


        OnLoad();


    });
</script>



@endsection
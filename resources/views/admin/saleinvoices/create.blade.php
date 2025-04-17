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
        <h4 class="text-themecolor">Sale Invoice
        </h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Sale Invoices</li>
            </ol>
        </div>
    </div>
</div>

<form method="post" class="myform" action="{{URL::to('admin/saleinvoices')}}" >
@csrf


<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white" >Invoice Info</h4>
            </header>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date <span class="text-danger" >*</span> </label>
                                <input required type="datetime-local"
                                value="{{old('date')}}"
                                name="date" class="form-control" 
                                placeholder="Date" />
                                @if($errors->has('date'))
                                 <p class="text-danger" >{{ $errors->first('date') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Due Date</label>
                                <input type="datetime-local"
                                value="{{old('date')}}"
                                name="due_date" class="form-control" 
                                placeholder="Due Date" />
                                @if($errors->has('due_date'))
                                 <p class="text-danger" >{{ $errors->first('due_date') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Ref No</label>
                                <input value="{{old('ref')}}" name="ref" class="form-control" placeholder="Ref No" />
                                @if($errors->has('ref'))
                                 <p class="text-danger" >{{ $errors->first('ref') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Is Paid</label>
                                <select name="is_paid" class="form-control" >
                                    <option @if(old('is_paid') == 0) selected @endif value="0">No</option>
                                    <option @if(old('is_paid') == 1) selected @endif value="1">Yes</option>
                                </select>
                                @if($errors->has('is_paid'))
                                 <p class="text-danger" >{{ $errors->first('is_paid') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Customer <span class="text-danger" >*</span></label>
                                <select required class="form-control" name="customer">
                                    <option>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option @if(old('customer') == $customer->id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('customer'))
                                 <p class="text-danger" >{{ $errors->first('customer') }}</p>
                                @endif 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <input value="{{old('description')}}" name="description" class="form-control" placeholder="Description" />
                                @if($errors->has('description'))
                                 <p class="text-danger" >{{ $errors->first('description') }}</p>
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
                <h4 class="mb-0 text-white">Invoice Items</h4>
            </header>
            <div class="card-body"> 
                <div class="row ">
                    <div class="m-auto col-md-6 text-center  d-flex">
                        <select class="product">
                            <option value="">Select Item</option>
                            @foreach ($products as $p)
                            <option data-id="{{$p->id}}" data-price="{{$p->price}}" value="{{$p->id}}">{{$p->title}}</option>  
                            @endforeach
                        </select>
                        <button class="btn btn-success add m-md-0 mt-2" type="button" >+</button>
                    </div>
               </div>
               <hr>
               <div class="items">
               </div>
      </section>
   </div>



   <div class="col-lg-12 sumary-sections">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Invoice Summary</h4>
            </header>
            <div class="card-body"> 
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label" >Subtotal :</label>
                    </div>
                    <div class="col-md-10">
                        <input readonly name="subtotal" value="" class="subtotal form-control" />
                    </div>
               </div>
               <hr>
               <div class="row">
                    <div class="col-md-2">
                        <label class="form-label" >Adjustments :</label>
                    </div>
                    <div class="col-md-10 additionals">
                    
                    </div>
               </div>
               <div class="row mt-2 mb-2">
                    <div class="col-12 text-center">
                        <button class="btn btn-success add_adjustment" type="button" >+</button>
                    </div>
               </div>
               <hr>
               <div class="row">
                    <div class="col-md-2">
                        <label class="form-label m-0" >Grand Total :</label>
                    </div>  
                    <div class="col-md-10">
                        <input readonly  name="grandtotal" value="" class="grandtotal form-control" />
                    </div>
              </div>
            </div>
        </section>
   </div>

   <div class="col-lg-12 items-sections">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Additional Details</h4>
            </header>
            <div class="card-body"> 
                <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
            </div>
        </section>
   </div>

   <div class="col-md-12 text-center pb-3">
     <button class="btn btn-primary" type="submit">Submit</button>
   </div>

   </div>
</form>

@endsection
@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        let grandtotal = $('.grandtotal');
        let subtotal = $('.subtotal');
        let additionals = $('.additionals');
        let items = $('.items');
        let itemssections = $('.items-sections');

        $('.product').select2({
            placeholder: "Select Item..",
            allowClear: true
        });

        function calculateTotals() {
            
                    let stotal = 0;
                    let gtotal = 0;

                    items.find('.row').each(function () {
                        const price = parseFloat($(this).find('.price').val()) || 0;
                        const quantity = parseFloat($(this).find('.quantity').val()) || 0; 
                        const tax = parseFloat($(this).find('.tax').val()) || 0;
                        const discount = parseFloat($(this).find('.discount').val()) || 0; 
                        let total = price * quantity;
                        total = total - discount;
                        total = total + tax;
                        $(this).find('.total').val(total.toFixed(2));
                        stotal +=  total;
                    });

                    subtotal.val(stotal.toFixed());
    
                    additionals.find('.border').each(function(index, element) {

                        let el = $(this);
                        let value =  parseFloat(el.find('.value').val()) || 0;
                        let operator = el.find('.operator').val();
                        let type = el.find('.type').val();

                        if (type === 'percent') {
                            value = (stotal * value) / 100;
                        }

                        if (operator === '+') {
                            stotal += value;
                        } else if (operator === '-') {
                            stotal -= value;
                        }
                    });

                    grandtotal.val(stotal.toFixed());
        }


        // ____________________________________ ITems

        itemssections.on('click','.add',function(){

                    let p = $('.product option:selected');
                    if(p.val() == ""){
                        alert('Please Select Product');
                        return false;
                    }

                    let uid = Date.now() + Math.floor(Math.random() * 1000);

                    $('.items').append(`<div class="border my-4 row py-2">
                        <div class="col-md-6 my-2">
                            <div class="from-group">
                                <label class="form-label">Product</label>
                                <input readonly class="form-control" value="${p.text()}" />
                                <input type="hidden" name="items[${uid}][product_id]" value="${p.val()}" />
                            </div>
                        </div>
                        <div class="col-md-6 my-2">
                            <div class="from-group">
                                <label class="form-label">Description</label>
                                <input required class="form-control" name="items[${uid}][description]" value="" />
                            </div>
                        </div>
                        <div class="col-md-3 my-2">
                            <div class="from-group">
                                <label class="form-label">Price</label>
                                <input required class="form-control price" type="number" name="items[${uid}][price]" step="any" value="${p.data('price')}" />
                            </div>
                        </div>
                        <div class="col-md-3 my-2">
                            <div class="from-group">
                                <label class="form-label">Quantity</label>
                                <input required class="form-control quantity" type="number" step="any" name="items[${uid}][quantity]" value="0" />
                            </div>
                        </div>
                        <div class="col-md-3 my-2">
                            <div class="from-group">
                                <label class="form-label">Discount</label>
                                <input class="form-control discount" type="number" name="items[${uid}][discount]" step="any" value="0" />
                            </div>
                        </div>
                        <div class="col-md-3 my-2">
                            <div class="from-group">
                                <label class="form-label">Tax</label>
                                <input class="form-control tax" type="number" step="any" name="items[${uid}][tax]" value="0" />
                            </div>
                        </div>
                        <div class="col-md-12 my-2 ">
                            <div class="from-group">       
                                <div class="d-flex">
                                    <input value="0" readonly type="number" class="form-control total" name="items[${uid}][total]" />
                                    <button class="btn btn-danger remove" type="button" >X</button>
                                </div>
                            </div>
                        </div>
                    </div> `);


                    calculateTotals();
                    $('.product').val(null).trigger('change');

        });


        $('.items').on('click', '.remove', function () {
            $(this).parent().parent().parent().parent().remove();
            calculateTotals();
        });





        // _______________________________ Adjustment

        $('.add_adjustment').click(function (e) { 

            let uid = Date.now() + Math.floor(Math.random() * 1000);

            $('.additionals').append(`
                <div class="border row my-3 py-3 ">
                    <div class="col-md-4 text-left">
                        <input required placeholder="Title" name="adjustments[${uid}][title]" value="" class="form-control title" />
                    </div>
                    <div class="col-md-2 text-left">
                        <input required placeholder="Value" type="number" name="adjustments[${uid}][value]" value="" class="form-control value" />
                    </div>
                    <div class="col-md-2 text-left">
                        <select required name="adjustments[${uid}][operator]" class="form-control operator" >
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-left">
                        <select required name="adjustments[${uid}][type]" class="form-control type">
                            <option value="percent">Percent</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger remove_adjustment" type="button">X</button>
                    </div>
                </div>
            
            `);
        });

        $('.additionals').on('click', '.remove_adjustment', function () {
            $(this).parent().parent().remove();
            
        });

        $('.myform').on('change', function () {
           calculateTotals();
        });

        calculateTotals();



    });
</script>



@endsection
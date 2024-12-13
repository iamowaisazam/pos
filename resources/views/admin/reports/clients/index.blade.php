@extends('admin.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">

<link rel="stylesheet" href="{{asset('admin/assets/css/pages/search-table.css')}}">
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ALL CUSTOMERS LIST 
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">customers</li>
                </ol>
            </div>
        </div>
    </div>


    <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header bg-info">
                                <h4 class="mb-0 text-white" >All Customer Filters</h4>
                            </header>
                        <div class="card-body">    
                          <div class="table-responsive">
                          <div class="container">
    <form id="orderForm">
        <div class="row">
            <div class="col">
                <label for="customerName">Customer Name:</label>
                <input type="text" class="customerName" id="customerName" name="customerName" >
            </div>
            <div class="col">
                <label for="email">Email:</label>
                <input type="email" class="email" id="email" name="email" >
            </div>
            <div class="col">
                <label for="phone">Phone:</label>
                <input type="tel" class="phone" id="phone" name="phone" >
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <label for="address">Address:</label>
                <input type="text" class="address" id="address" name="address" >
            </div>
            <div class="col">
                <label for="orderNumber">Order Number:</label>
                <input type="text" class="orderNumber" id="orderNumber" name="orderNumber" >
            </div>
            <!-- <div class="col">
                <label for="totalAmount">Total Amount:</label>
                <input type="number" class="totalAmount" id="totalAmount" name="totalAmount" >
            </div> -->
        </div>
        
        <div class="row">
            <div class="col">
                <label for="paymentMethod">Payment Method:</label>
                <select class="paymentMethod" id="paymentMethod" name="paymentMethod" >
                    <option value="">Select - Payment Method</option>
                    <!-- <option value="cash_on_delivery">Cash on Delivery</option> -->
                    @if($PaymentMethod)
                    @foreach($PaymentMethod as $val)
                    <option value="{{$val->id}}">{{$val->title}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col">
                <label for="orderStatus">Order Status:</label>
                <select id="orderStatus" class="orderStatus" name="orderStatus" >
                    <option value="">Select - Order status</option>
                    @if($status)
                    @foreach($status as $val)
                    <option value="{{$val->id}}">{{$val->title}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            
            <div class="col">
                <label for="paymentStatus">Payment Status:</label>
                <select id="paymentStatus" class="paymentStatus" name="paymentStatus" >
                    <option value="">Select - Payment Status</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>
        </div>
        <div class="row">
        <div class="col">
                <label for="startDate">Start Date:</label>
                <input type="date" class="startDate" id="startDate" name="startDate" >
            </div>
            <div class="col">
                <label for="endDate">End Date:</label>
                <input type="date" class="endDate" id="endDate" name="endDate" >
            </div>
        </div>
        
        <div class="sidebar">
            <button type="button" class="search_result" id="searchorders">Search</button>
            <button class="btn_pdf">Export PDF</button>
            <button class="btn_exe">Export Excel</button>
        </div>
    </form>
</div>
                           
                    </div>
                    </div>
                </div>
           </section>
        </div>
                    <div class="col-sm-12">
                        <section class="card">
                            <header class="card-header bg-info">
                                <h4 class="mb-0 text-white" >All Customer List</h4>
                            </header>
                        <div class="card-body">    
                          <div class="table-responsive">
                          <div class="container">
      <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                    <thead>
                                       
                                        <tr class="" >
                                            <th>Order id</th> 
                                            <th>Order Date</th>   
                                            <th>Customer name</th>
                                            <th>Email</th>
                                            <th>Phone </th>    
                                            <th>Address</th>   
                                            <th>Order status</th>
                                            <th>Payment method</th>
                                            <th>Payment status</th>
                                            <th>Total ammount</th>
                                        </tr>
                                     </thead>
                                    <tbody>
                             </tbody>
                        </table>

                        </div>
                    </div>
                </div>
           </section>
        </div>
      </div>

@endsection
 @section('js')
        
       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
      
    

       <script>
        $(function () {
            
            var application_table = $('.mydatatable').DataTable({
            processing: true,
            "searching": true,  
            fixedColumns: false,
            fixedHeader: false,
            scrollCollapse: false,
            scrollX: true,
            // scrollY: '500px',
            autoWidth: false, 
            dom: 'lfrtip',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to('admin/reports/clients/index')}}",
                type: "GET",
                data: function ( d ) {
                    d.name = $(".customerName").val();
                    d.email = $(".email").val();
                    d.phone = $(".phone").val();
                    d.address = $(".address").val();
                    d.orderNumber = $(".orderNumber").val();
                    d.totalAmount = $(".totalAmount").val();
                    d.paymentMethod = $(".paymentMethod").val();
                    d.orderStatus = $('.orderStatus').val();
                    d.paymentStatus = $('.paymentStatus').val();
                    d.startDate = $('.startDate').val();
                    d.endDate = $('.endDate').val();
                   
                    

                   
                }
            },
            initComplete: function () {  
                $('.js-switch').each(function () {
                   new Switchery($(this)[0], $(this).data());
                 });               
            }
        });
        $('.search_result').click(function(){          
            application_table.draw();
            // alert("hello");
        });
        // $('input[type=search]').unbind();
        $("#searchButton").click(e =>{ 
            application_table.search($('input[type=search]').val());
            application_table.draw();
        });

        $("#example23 thead .row-checkbox").change(function (e) { 
            var isChecked = $(this).prop('checked');
            $('#example23 tbody .row-checkbox').prop('checked', isChecked);
        });

      });
      
    </script>
@endsection
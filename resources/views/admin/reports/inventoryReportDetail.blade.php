@extends('admin.partials.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">


<style>
    
    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {       
            overflow: scroll!important;
        }
    }

    .dataTables_info {
     float: right;
    }

</style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Product
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Reports</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h4 class="mb-0 text-white">{{$model->title}}</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a class="mx-1 btn btn-primary" href="{{URL::to('admin/reports/inventoryReport')}}">Back</a>
                        </div>
                    </div>
                </header>
            <div class="card-body">    
                <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                        <thead>
                            <tr class="" >
                                <th>#</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Stock In</th>
                                <th>Stock Out</th>
                                <th>Balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                        <tbody>
                    </tbody>
            </table>
        </div>
    </div>
</section>
</div>
@endsection
@section('js')

       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
       <script src="https://www.fatwaqa.com/admin/assets/node_modules/switchery/dist/switchery.min.js"></script>

       <?php $url = URL::to('admin/reports/inventoryReportDetail/'.Crypt::encryptString($model->id));?>

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
            dom: 'lirtp',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to($url)}}",
                type: "GET",
                data: function ( d ) {  
                    d.search = $('input[name=search]').val();

                }
            },
            initComplete: function () {                
            }
        });

        application_table.on( 'draw', function () {
        
        });

       
        $(".search_btn").click(e =>{ 
            application_table.draw();
        });

        $('input[name=search]').change(function (e) { 
            application_table.draw();
        });

      });
    </script>
@endsection
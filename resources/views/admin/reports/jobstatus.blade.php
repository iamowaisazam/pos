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
            <h4 class="text-themecolor">Job Status</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Job Status</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white" >Search</h4>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Job Number</label>
                                <input class="form-control" name="job_number" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input class="form-control" name="company_name" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input class="form-control" name="customer_name" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>LC Number</label>
                                <input class="form-control" name="lc_no" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" >
                                    <option value="">Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Search</label>
                                <input class="form-control" name="search" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="search_btn btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h4 class="mb-0 text-white">Job Status</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            {{-- <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Create New </button> --}}
                        </div>
                    </div>
                </header>
                <div class="card-body">    
                    <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                    <thead>
                        <tr class="">
                            <th>#</th>
                            <th class="text-center">Job</th>
                            <th>Consignment </th>
                            <th>Payorder</th>
                            <th class="text-center" >DC</th>
                            <th>Intimation</th>
                            <th>Payment</th>
                            <th>Progress</th>
                        </tr>
                     </thead>
                    <tbody>
                        <tr>
                                <td>#</td>
                                <td>OS-001</td>
                                <td>10-12-2024</td>
                                <td>10-12-2024</td>
                                <td>10-12-2024</td>
                                <td>10-12-2024</td>
                                <td></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                          </tr>
                          <tr>
                                <td>#</td>
                                <td>OS-002</td>
                                <td>10-12-2024</td>
                                <td>10-12-2024</td>
                                <td>10-12-2024</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                          </tr> 
                          <tr>
                                <td>#</td>
                                <td>OS-002</td>
                                <td><span class="badge bg-success rounded-pill">Complete</span></td>
                                <td><span class="badge bg-success rounded-pill">Complete</span></td>
                                <td><span class="badge bg-danger rounded-pill">Uncomplete</span></td>
                                <td><span class="badge bg-danger rounded-pill">Uncomplete</span></td>
                                <td><span class="badge bg-danger rounded-pill">Uncomplete</span></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                          </tr>          
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
            // serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            // ajax: {
            //     url: "{{URL::to('admin/delivery-challans')}}",
            //     type: "GET",
            //     data: function ( d ) {  

            //         d.job_number = $('input[name=job_number]').val();
            //         d.company_name = $('input[name=company_name]').val();
            //         d.customer_name = $('input[name=customer_name]').val();
            //         d.lc_no = $('input[name=lc_no]').val();
            //         d.status = $('select[name=status]').val();
            //         d.search = $('input[name=search]').val();

            //     }
            // },
            initComplete: function () {                
            }
        });

        application_table.on( 'draw', function () {
            $('.js-switch').each(function () {
               new Switchery($(this)[0], $(this).data());
            }); 
        } );

        $(".search_btn").click(e =>{ 
            // application_table.draw();
        });

        $('input[name=search]').change(function (e) { 
            // application_table.draw();
        });


        $(".mydatatable").delegate(".is_status", "change", function(){

            $.toast({
                heading: "Status Change Successfully",
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6,
            });

            var isChecked = $(this).prop('checked');
            $.ajax({
                url: "{{URL::to('/admin/status')}}",
                method:"POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    id:$(this).data('id'),
                    table:'delivery_challans',
                    column:'status',
                    value: $(this).prop('checked') ? 1: 0,
                },
                dataType: "json",
                success: function (response) {
                    
                },
                errror:function (response) {
                    
                },
            });
        });

        
        $(".mydatatable").delegate(".delete_btn", "click", function(){
            
            var id = $(this).data('id'); 
            $.ajax({
                url:id,
                method:"delete",
                data:{
                  '_token': "{{ csrf_token() }}",
                },
                success: function (response) {
                    
                    $.toast({
                        heading: response.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6,
                    });
                    application_table.draw();
                },
                error:function (response) {
                    
                    $.toast({
                    heading: response?.responseJSON?.message ? response?.responseJSON?.message : 'Something Went Wrong',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6,
                    });
                },
            });


        });

    });
    </script>
@endsection
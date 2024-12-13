@extends('admin.partials.layout')

@section('css')
 
    <style>

		.dashboard_boxes .card-body{
			background: #0e2843; 
		}

		.dashboard_boxes h3{
			color: #fff !important;
			font-size: 14px !important;
			font-weight: 500 !important;
		}
 
</style>
    
@endsection

@section('content')

@if(Auth::user()->permission('users.dashboard'))

<?php 

$dashboard = [
	'User Management',
	'Customer Management',
	'Vendor Management',
	'Jobs / Consignment Management',
	// 'Consignment Management',
	// 'Payment Request Management',
	// 'Delivery Challan Management',
	// 'Jobs Tracking Management',
	// 'Customer Statements Management',
	// 'Finance Management',
];


?>

                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>

				<div class="row dashboard_boxes">
                    <!-- .col -->
					@foreach ($dashboard as $item)
						<div class="col-md-4 col-lg-4 col-xl-4">
							<div class="card card-body dark">
								<div class="row align-items-center">
									<div class="col-md-4 col-lg-3 text-center">
										<a href="#"><img src="{{asset('admin/assets/images/users/1.jpg')}}" width="90" class="img-circle img-fluid"></a>
									</div>
									<div class="col-md-8 col-lg-8">
										<h3 class="box-title m-b-0 color-white">{{$item}}</h3>
									</div>
								</div>
							</div>
						</div>
					@endforeach

                    {{-- <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="card card-body dark">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-lg-3 text-center">
                                    <a href="app-contact-detail.html"><img src="../assets/images/users/1.jpg" width="90" alt="user" class="img-circle img-fluid"></a>
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <h3 class="box-title m-b-0 color-white">Reports Management</h3>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="card card-body darkk">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-lg-3 text-center">
                                    <a href="app-contact-detail.html"><img src="../assets/images/users/1.jpg" width="90" alt="user" class="img-circle img-fluid"></a>
                                </div>
                                <div class="col-md-8 col-lg-8">
                                    <h3 class="box-title m-b-0 color-white">Master Data</h3>
                                   
                                </div>
                            </div>
                        </div>
                    </div> --}}
              
                 
                </div>
   

                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <div class="d-none row g-0">
					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-screen-desktop"></i></h3>
												<p class="text-muted">ORDER,S</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-primary">{{ $totalOrder }}</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-note"></i></h3>
												<p class="text-muted">COLLECTION</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-cyan">{{ $totalCollection }}</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-doc"></i></h3>
												<p class="text-muted">CATEGORY</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-purple">{{$totalCategory}}</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-bag"></i></h3>
												<p class="text-muted">PRODUCTS</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-success">{{$totalProduct}}</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!-- ============================================================== -->
                <!-- End Info box -->
                <!-- ============================================================== -->

@endif
@endsection
@section('js')
<script>

    $(function () {
        "use strict";
       
    });
</script>
@endsection
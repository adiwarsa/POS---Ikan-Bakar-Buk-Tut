<x-app-layout title="Home">
	<div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card mb-4">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Halo, {{ auth()->user()->name }}</h4>
                            <p class="mb-4">
                                {{ $sekarang->format('l, j F Y') }}
                            </p>
                            <p style="font-size: smaller" class="text-gray">*)Laporan Bulan Ini</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                 alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                 data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                             style="position: relative;">
                            <div class="">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">Grafik Stock Item</h5>
                                    <span class="badge bg-label-warning rounded-pill">Bulan Ini</span>
                                </div>
                            </div>
                            <div id="profileReportChart" style="min-height: 80px; width: 80%">
                                <div id="today-graphic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="badge bg-label-info p-2">
										<i class="bx bx-user text-info"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
											<a class="dropdown-item"
											   href="{{ route('users.index') }}">{{ __('Lihat Detail') }}</a>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">User *</span>
							<h3 class="card-title mb-2">{{ $jumlahuser }}</h3>
						</div>
					</div>
                </div>
				<!-- Pembatas -->
				<div class="col-lg-6 col-md-12 col-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="badge bg-label-primary p-2">
										<i class="bx bx-package text-primary"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
											<a class="dropdown-item"
											   href="{{ route('stock.index') }}">{{ __('Lihat Detail') }}</a>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">Items *</span>
							<h3 class="card-title mb-2">{{ $jumlahstock }}</h3>
						</div>
					</div>
                </div>
				<!--Pembatas-->
				<!-- Pembatas -->
				<div class="col-lg-6 col-md-12 col-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="badge bg-label-success p-2">
										<i class="bx bx-message-square-add text-success"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
											<a class="dropdown-item"
											   href="{{ route('stockin.index') }}">{{ __('Lihat Detail') }}</a>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">Stock In *</span>
							<h3 class="card-title mb-2">{{ $jumlahstockin }}</h3>
						</div>
					</div>
                </div>
				<!--Pembatas-->
				<div class="col-lg-6 col-md-12 col-6 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="card-title d-flex align-items-start justify-content-between">
								<div class="avatar flex-shrink-0">
									<span class="badge bg-label-danger p-2">
										<i class="bx bx-message-square-minus text-danger"></i>
									</span>
								</div>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
											<a class="dropdown-item"
											   href="{{ route('stockout.index') }}">{{ __('Lihat Detail') }}</a>
									</div>
								</div>
							</div>
							<span class="fw-semibold d-block mb-1">Stock Out *</span>
							<h3 class="card-title mb-2">{{ $jumlahstockout }}</h3>
						</div>
					</div>
                </div>
				<!--Pembatas-->
            </div>
        </div>
    </div>

	<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        const options = {
            chart: {
                type: 'bar'
            },
            series: [{
                name: 'Jumlah',
                data: [{{ $sinmonth }},{{ $soutmonth }}]
            }],
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                categories: [
                    'Stock In',
                    'Stock Out',
                ],
            }
        }

        const chart = new ApexCharts(document.querySelector("#today-graphic"), options);

        chart.render();
    </script>
</x-app-layout>
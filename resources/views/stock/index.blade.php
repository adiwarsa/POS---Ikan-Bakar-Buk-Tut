<x-app-layout title="Manajemen Stock">
	<x-breadcrumb
        :values="[__('Manajemen Stock'), __('Stock'),]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Manajemen Stock') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('stock.create') }}" class="btn btn-primary">
					{{ __('Buat baru') }}
				</a>
			</div>
			@if (auth()->user()->role == 1)
			<form action="" class="" method="get">
					<div class="row mt-3 d-flex justify-content-around">
						<div class="mb-3 col-md-4">
							<label for="start_date">Start</label>
							<input type="date" class="form-control border border-2 p-2" id="start_date" name="start_date">
						</div>
						<div class="mb-3 col-md-4">
							<label for="end_date">End</label>
							<input type="date" class="form-control border border-2 p-2" id="end_date" name="end_date">
						</div>
						<div class="mb-3 col-md-4 d-flex align-self-center">
							<button class="mt-4 btn btn-primary" type="submit" id="filterBtn">Filter</button>
						</div>
					</div>
			</form>
			@endif

			@include('stock._partials.table')

		</div>
	</div>
</x-app-layout>
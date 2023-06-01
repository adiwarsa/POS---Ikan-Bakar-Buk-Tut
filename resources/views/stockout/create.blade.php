<x-app-layout title="Tambah Stock Out">
	<x-breadcrumb
        :values="[__('Manajemen Stock Out'), __('Stock Out'), __('Tambah Stock Out')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Stock Out') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('stockout.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('stockout._partials.form')

		</div>
	</div>
</x-app-layout>
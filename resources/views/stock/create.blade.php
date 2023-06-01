<x-app-layout title="Tambah Stock">
	<x-breadcrumb
        :values="[__('Manajemen Stock'), __('Stock'), __('Tambah Stock')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Stock') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('stock.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('stock._partials.form')

		</div>
	</div>
</x-app-layout>
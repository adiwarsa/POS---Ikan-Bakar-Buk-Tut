<x-app-layout title="Tambah Stock">
	<x-breadcrumb
        :values="[__('Manajemen Stock In'), __('Stock In'), __('Tambah Stock In')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Stock In') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('stockin.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('stockin._partials.form')

		</div>
	</div>
</x-app-layout>
<x-app-layout title="Tambah Paket">
	<x-breadcrumb
        :values="[__('Manajemen Paket'), __('Paket'), __('Tambah Paket')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Paket') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('paket.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('paket._partials.form')

		</div>
	</div>
</x-app-layout>
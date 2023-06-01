<x-app-layout title="Manajemen Paket">
	<x-breadcrumb
        :values="[__('Manajemen Paket'), __('Paket'),]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Manajemen Paket') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('paket.create') }}" class="btn btn-primary">
					{{ __('Buat baru') }}
				</a>
			</div>

			@include('paket._partials.table')

		</div>
	</div>
</x-app-layout>
<x-app-layout title="Manajemen Supplier">
	<x-breadcrumb
        :values="[__('Manajemen Supplier'), __('Supplier'),]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Manajemen Supplier') }}
			</h5>
			<div class="mb-4">
				<a href="{{ route('supplier.create') }}" class="btn btn-primary">
					{{ __('Buat baru') }}
				</a>
			</div>
			
			@include('supplier._partials.table')

		</div>
	</div>
</x-app-layout>
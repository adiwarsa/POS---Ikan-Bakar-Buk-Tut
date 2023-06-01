<x-app-layout title="Tambah Transaction">
	<x-breadcrumb
        :values="[__('Manajemen Transaction'), __('Transaction'), __('Tambah Transaction')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Transaction') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('transaction.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>
			<div class="mb-4">
				<a href="#" class="btn btn-dark" id="total-button">
					{{ __('Total Price') }}
				</a>
			</div>

			@include('transaction._partials.form')

		</div>
	</div>
</x-app-layout>
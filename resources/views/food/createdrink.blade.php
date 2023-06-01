<x-app-layout title="Tambah Drink">
	<x-breadcrumb
        :values="[__('Manajemen Menu'), __('Drink'), __('Tambah Drink')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Drink') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('food.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('food._partials.formdrink')

		</div>
	</div>
</x-app-layout>
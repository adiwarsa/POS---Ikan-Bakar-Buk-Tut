<x-app-layout title="Tambah Food">
	<x-breadcrumb
        :values="[__('Manajemen Menu'), __('Food'), __('Tambah Food')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah Food') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('food.index') }}" class="btn btn-dark">
					{{ __('Kembali') }}
				</a>
			</div>

			@include('food._partials.form')

		</div>
	</div>
</x-app-layout>
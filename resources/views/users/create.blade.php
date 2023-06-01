<x-app-layout title="Tambah User">
	<x-breadcrumb
        :values="[__('Manajemen User'), __('User'), __('Tambah User')]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Tambah User') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('users.index') }}" class="btn btn-dark">
					{{ __('Back to list') }}
				</a>
			</div>

			@include('users._partials.form')

		</div>
	</div>
</x-app-layout>
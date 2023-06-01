<x-app-layout title="Edit Stock">
    <x-breadcrumb
        :values="[__('Manajemen Stock'), __('Stock'), __('Edit Stock')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Stock') }}
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
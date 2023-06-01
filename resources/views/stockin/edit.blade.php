<x-app-layout title="Edit Stock In">
    <x-breadcrumb
        :values="[__('Manajemen Stock In'), __('Stock In'), __('Edit Stock In')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Stock In') }}
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
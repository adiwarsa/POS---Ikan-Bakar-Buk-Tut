<x-app-layout title="Edit Paket">
    <x-breadcrumb
        :values="[__('Manajemen Paket'), __('Paket'), __('Edit Paket')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Paket') }}
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
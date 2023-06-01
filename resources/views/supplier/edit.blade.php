<x-app-layout title="Edit Supplier ">
    <x-breadcrumb
        :values="[__('Manajemen Supplier'), __('Supplier'), __('Edit Supplier')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Supplier') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('supplier.index') }}" class="btn btn-dark">
                    {{ __('Kembali') }}
                </a>
            </div>

            @include('supplier._partials.form')

        </div>
    </div>
</x-app-layout>
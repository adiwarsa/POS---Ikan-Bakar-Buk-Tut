<x-app-layout title="Edit Transaction">
    <x-breadcrumb
        :values="[__('Manajemen Transaction'), __('Transaction'), __('Edit Transaction')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Transaction') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('transaction.index') }}" class="btn btn-dark">
                    {{ __('Kembali') }}
                </a>
            </div>

            @include('transaction._partials.form')

        </div>
    </div>
</x-app-layout>
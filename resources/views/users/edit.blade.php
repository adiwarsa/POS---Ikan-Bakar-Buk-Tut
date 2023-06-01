<x-app-layout title="Edit User">
    <x-breadcrumb
        :values="[__('Manajemen User'), __('User'), __('Edit User')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit User') }}
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
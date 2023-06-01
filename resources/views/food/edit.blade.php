<x-app-layout :title="$food->type == 'makanan' ? 'Edit Food' : 'Edit Drink'">
    <x-breadcrumb
        :values="[__('Manajemen Menu'), $food->type == 'makanan' ? __('Food') : __('Drink'), $food->type == 'makanan' ? __('Edit Food') : __('Edit Drink')]">
    </x-breadcrumb>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Edit Food') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('food.index') }}" class="btn btn-dark">
                    {{ __('Kembali') }}
                </a>
            </div>
            @if ($food->type == 'makanan')
                @include('food._partials.form')
            @else
                @include('food._partials.formdrink') 
            @endif
        </div>
    </div>
</x-app-layout>
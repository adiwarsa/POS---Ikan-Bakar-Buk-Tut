<form action="{{ $paket->id ? route('paket.update', $paket->id) : route('paket.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($paket->id)
	@method("PUT")
	@endif

    <div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $paket->name)" />
	</div>
	<div class="row justify-content-center">
        <x-label for="Menu" :value="__('Menu')" />
		@foreach ($menu as $option)
		<div class="col-md-5">
			<div class="card rounded-3 mb-4">
				<div class="card-body p-2">
				<div class="row d-flex justify-content-between align-items-center">
					<div class="col-md-1 col-lg-1 col-xl-1">
				<input width="0" type="checkbox" name="menu[]" value="{{ $option->id }}" id="{{ $option->id }}">
				</div>
					<div class="col-md-3 col-lg-3 col-xl-3">
					<p class="lead fw-normal mb-2">{{ $option->name }}</p>
					<p><span class="text-muted">Type: </span>{{ ucfirst($option->type) }} </p>
					</div>
					<div class="col-md-3 col-lg-3 col-xl-3 d-flex">
					<button class="btn btn-link px-2"
						onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
						<i class="fas fa-minus"></i>
					</button>

					<input id="quantity-{{ $option->id }}" min="0" name="quantity[{{ $option->id }}]" value="0" type="number"
  class="form-control form-control-sm"/>

					<button class="btn btn-link px-2"
						onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
						<i class="fas fa-plus"></i>
					</button>
					</div>
				</div>
				</div>
			</div>
	</div>
	@endforeach
</div>
    <div class="mb-3">
		<x-label for="price" :value="__('Price')" />
		<x-input type="number" name="price" id="price" :placeholder="__('Price')" :value="old('price', $paket->price)" />
	</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$paket->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>
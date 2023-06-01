<form action="{{ $food->id ? route('food.update', $food->id) : route('food.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($food->id)
	@method("PUT")
	@endif

    <div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $food->name)" />
		<input type="hidden" name="type" value="makanan">
		</div>
	<div class="mb-3">
		<x-label for="jenis" :value="__('jenis')" />
								<select class="form-select" id="jenis" name="jenis">
										<option
											value="Alacarte"
											@selected(old('jenis') == 'Alacarte')>Alacarte</option>
										<option
											value="Side Dish"
											@selected(old('jenis') == 'Side Dish')>Side Dish</option>
                                        <option
											value="Vegetable"
											@selected(old('jenis') == 'Vegetable')>Vegetable</option>
								</select>
	</div>

	<div class="mb-3">
		<x-label for="for" :value="__('for')" />
								<select class="form-select" id="for" name="for">
										<option
											value="Paket"
											@selected(old('for') == 'Paket')>Paket</option>
										<option
											value="Non Paket"
											@selected(old('for') == 'Non Paket')>Non Paket</option>
								</select>
	</div>

	<div class="mb-3">
		<x-label for="Item" :value="__('Item')" />
		<select class="form-select" id="id_stock" name="id_stock">
			@foreach($stock as $stck)
				<option value="{{ $stck->id }}"
					{{ $food->id_stock == $stck->id ? 'selected' : '' }}>
					{{ $stck->name }}
				</option>
			@endforeach
		</select>
	</div>
    <div class="mb-3">
		<x-label for="needqty" :value="__('Need Qty')" />
		<x-input type="number" name="needqty" id="needqty" :placeholder="__('Need Qty')" :value="old('needqty', $food->needqty)" />
	</div>
    <div class="mb-3">
		<x-label for="price" :value="__('Price')" />
		<x-input type="number" name="price" id="price" :placeholder="__('Price')" :value="old('price', $food->price)" />
	</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$food->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>
<form action="{{ $stockin->id ? route('stockin.update', $stockin->id) : route('stockin.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($stockin->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="Supplier" :value="__('Supplier')" />
		<select class="form-select" id="id_supplier" name="id_supplier">
			@foreach($supplier as $spr)
				<option value="{{ $spr->id }}"
					{{ $stockin->id_supplier == $spr->id ? 'selected' : '' }}>
					{{ $spr->nama }}
				</option>
			@endforeach
		</select>
	</div>
	<div class="mb-3">
		<x-label for="Item" :value="__('Item')" />
		<select class="form-select" id="id_stock" name="id_stock">
			@foreach($stock as $stck)
				<option value="{{ $stck->id }}" data-type="{{ $stck->type }}"
					{{ $stockin->id_stock == $stck->id ? 'selected' : '' }}>
					{{ $stck->name }}
				</option>
			@endforeach
		</select>
	</div>

    <div class="mb-3">
		<x-label for="price" :value="__('price')" />
		<x-input type="number" name="price" id="price" :placeholder="__('Price')" :value="old('price', $stockin->price)" />
	</div>
    <div class="mb-3">
		<x-label id="label-type" for="qty" :value="__('Kg/Box')" />
		<x-input type="number" name="qty" id="qty" :placeholder="__('Qty')" :value="old('qty', $stockin->qty)" />
	</div>
    <div class="mb-3">
		<x-label for="date_in" :value="__('Date In')" />
		<x-input type="date" name="date_in" id="date_in" :placeholder="__('Date In')" :value="old('date_in', $stockin->date_in)" autofocus />
	</div>
    <div class="mb-3">
		<x-label for="File" :value="__('File')" />
		<x-input type="file" name="file" id="file" />
	</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$stockin->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectStock = document.getElementById('id_stock');
        var labelType = document.getElementById('label-type');

        selectStock.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var selectedType = selectedOption.dataset.type;
            var labelTypeText = '';

            // Update the label value based on the selected option's type
            switch (selectedType) {
                case 'Kg':
                    labelTypeText = 'Kg';
                    break;
                case 'Box':
                    labelTypeText = 'Box';
                    break;
            }

            // Update the label text
            labelType.textContent = labelTypeText;
        });

        // Trigger the change event on page load
        selectStock.dispatchEvent(new Event('change'));
    });
</script>







<form action="{{ $stockout->id ? route('stockout.update', $stockout->id) : route('stockout.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($stockout->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="Item" :value="__('Item')" />
		<select class="form-select" id="id_stock" name="id_stock">
			@foreach($stock as $stck)
				<option value="{{ $stck->id }}" data-type="{{ $stck->type }}"
					{{ $stockout->id_stock == $stck->id ? 'selected' : '' }}>
					{{ $stck->name }}
				</option>
			@endforeach
		</select>
	</div>
    <div class="mb-3">
		<x-label id="label-type" for="qty" :value="__('Kg/Box')" />
		<x-input type="number" name="qty" id="qty" :placeholder="__('Qty')" :value="old('qty', $stockout->qty)" />
	</div>
    <div class="mb-3">
		<x-label for="date_out" :value="__('Date Out')" />
		<x-input type="date" name="date_out" id="date_out" :placeholder="__('Date In')" :value="old('date_out', $stockout->date_out)" autofocus />
	</div>
	<div class="mb-3">
		<x-label for="Description" :value="__('Description')" />
		<x-input-text-area name="description" id="description" :placeholder="__('Description')" :value="old('menimbang', $stockout->description)" />
	</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$stockout->id ? __('Ubah') : __('Simpan')" />
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
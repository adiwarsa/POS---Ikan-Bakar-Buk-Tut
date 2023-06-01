<form action="{{ $supplier->id ? route('supplier.update', $supplier->id) : route('supplier.store') }}" method="POST">
	@csrf

	@if($supplier->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="nama" :value="__('Name')" />
		<x-input type="text" name="nama" id="nama" :placeholder="__('Name')" :value="old('name', $supplier->nama)" autofocus />
	</div>

    <div class="mb-3">
		<x-label for="Phone Number" :value="__('Phone Number')" />
		<x-input type="number" pattern="\d*" name="telp" id="telp" :placeholder="__('Phone Number')" :value="old('Phone Number', $supplier->telp)" />
	</div>

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$supplier->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>
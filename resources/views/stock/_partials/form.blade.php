<form action="{{ $stock->id ? route('stock.update', $stock->id) : route('stock.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($stock->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('nama', $stock->name)" autofocus />
	</div>
	<div class="mb-3">
		<x-label for="type" :value="__('type')" />
								<select class="form-select" id="type" name="type">
										<option
											value="Box"
											{{ $stock->type == 'Box' ? 'selected' : '' }}>
										Box
									</option>
										<option
											value="Kg"
											{{ $stock->type == 'Kg' ? 'selected' : '' }}>
										Kg</option>
								</select>
	<div class="mb-3 mt-2">
		<x-label for="limits" id="pcsbox" :value="__('Pcs (Box)')" />
		<x-input type="number" name="limits" id="limits" :placeholder="__('Pcs')" :value="old('limits', $stock->limits)" />
	</div>
	@if (!$stock->id)
	<div class="mb-3">
		<x-label for="Kg/Box" id="qtybox" :value="__('Qty (Box)')" />
		<x-input type="number" name="qtytype" id="qtytype" min="0" step=".01" :placeholder="__('Qty')" :value="old('Jabatan', $stock->qtytype)" />
	</div>	
	@endif
	
	@if ($stock->id)
	<div class="mb-3">
		<x-label for="qty" :value="__('Qty Pcs')" />
		<x-input type="number" name="qty" id="qty" :placeholder="__('Qty Pcs')" :value="old('Jabatan', $stock->qty)" />
	</div>
	@endif
	<div class="mb-3">
		<x-label for="code" :value="__('Code')" />
		<x-input type="code" name="code" id="code" :placeholder="__('Code')" :value="old('Jabatan', $stock->code)" />
	</div>

    <div class="col-sm-12 col-12 col-md-6 col-lg-12">
		<x-label for="File" :value="__('Image')" />
		<x-input type="file" name="image" id="image" />
	</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$stock->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>

<script>

var type = document.getElementById("type").value;
var label = document.getElementById("pcsbox");
var labelqty = document.getElementById("qtybox");
if (type == "Kg") {
  label.textContent = "Pcs/Kg";
  labelqty.textContent = "Qty (Kg)";
}

document.getElementById("type").addEventListener("change", function() {
  var type = this.value;
  var label = document.getElementById("pcsbox");
  var labelqty = document.getElementById("qtybox");
  if (type == "Box") {
    label.textContent = "Pcs (Box)";
	labelqty.textContent = "Qty (Box)";
  } else if (type == "Kg") {
    label.textContent = "Pcs/Kg";
	labelqty.textContent = "Qty (Kg)";
  }
});

</script>
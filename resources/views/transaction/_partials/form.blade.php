<form action="{{ $transaction->id ? route('transaction.update', $transaction->id) : route('transaction.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($transaction->id)
	@method("PUT")
	@endif

    <div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $transaction->name)" required/>
	</div>
	<div class="row">
        <x-label for="Menu" :value="__('Menu')" />
		@foreach ($menu as $option)
		<div class="col-md-6">
			<div class="card rounded-3 mb-4">
				<div class="card-body p-2">
				<div class="row d-flex justify-content-between align-items-center">
					<div class="col-md-1 col-lg-1 col-xl-1">
				<input width="0" type="checkbox" name="menu_id[]" value="{{ $option->id }}" id="{{ $option->id }}">
				</div>
					<div class="col-md-3 col-lg-3 col-xl-3">
					<p class=" fw-normal mb-2">{{ $option->name }}</p>
					<p><span class="text-muted">Type: </span>{{ ucfirst($option->type) }} </p>
					</div>
					<div class="col-md-3 col-lg-3 col-xl-2 d-flex">
					<button class="btn btn-link px-2"
						onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
						<i class="fas fa-minus"></i>
					</button>

					<input id="menu_qty-{{ $option->id }}" min="0" name="menu_qty[{{ $option->id }}]" value="0" type="number"
  class="form-control form-control-sm" onchange="updatePrice(this); priceMenu(this);" />

					<button class="btn btn-link px-2"
						onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
						<i class="fas fa-plus"></i>
					</button>
					</div>
					<div class="col-md-3 ">
					<h5 class="mb-0 price" data-price="{{ $option->price }}" >Rp. 0</h5>
					</div>
				</div>
				</div>
			</div>
	</div>
	@endforeach
</div>

<div class="row">
    <x-label for="Paket" :value="__('Paket')" />
    @foreach ($paket as $option)
    <div class="col-md-6">
        <div class="card rounded-3 mb-4">
            <div class="card-body p-2">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-1 col-lg-1 col-xl-1">
            <input width="0" type="checkbox" name="paket_id[]" value="{{ $option->id }}" id="{{ $option->id }}">
            </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">{{ $option->name }}</p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                </button>

                <input id="paket_qty-{{ $option->id }}" min="0" name="paket_qty[{{ $option->id }}]" value="0" type="number"
                    class="form-control form-control-sm" onchange="updatePrice(this); pricePaket(this);"/>

                <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus"></i>
                </button>
                </div>
                <div class="col-md-3">
                <h5 class="mb-0 pricepaket" data-pricepaket="{{ $option->price }}">Rp. 0</h5>
                </div>
                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                </div>
            </div>
            </div>
        </div>
</div>
@endforeach
</div>

<div class="mb-3">
    <x-label for="pay" :value="__('Pay')" />
    <x-input type="number" name="pay" id="pay" :placeholder="__('Pay')" :value="old('pay', $transaction->pay)" />
</div>

	<div class="text-end mt-2">
		<x-button type="submit" class="btn btn-primary" :value="$transaction->id ? __('Ubah') : __('Simpan')" />
	</div>
</form>
<script>
    function priceMenu(input) {
      // Get the price element for this menu item
      const priceElement = input.closest('.card-body').querySelector('h5[data-price]');
      
      // Get the current price and quantity
      const price = parseFloat(priceElement.dataset.price);
      const qty = parseInt(input.value);
      
      // Calculate the new price based on the quantity
      const newPrice = price * qty;
      
      // Update the price element
      priceElement.textContent = 'Rp.' + newPrice;
    }

    function pricePaket(input) {
      // Get the price element for this menu item
      const priceElement = input.closest('.card-body').querySelector('h5[data-pricepaket]');
      
      // Get the current price and quantity
      const price = parseFloat(priceElement.dataset.pricepaket);
      const qty = parseInt(input.value);
      
      // Calculate the new price based on the quantity
      const newPrice = price * qty;
      
      // Update the price element
      priceElement.textContent = 'Rp.' + newPrice;
    }

    function updatePrice(input) {
    // Get all the checked checkboxes and calculate the total price
    let totalPrice = 0;
    const checkboxes = document.querySelectorAll('input[name="menu_id[]"]:checked');
    checkboxes.forEach(function(checkbox) {
        const priceElement = checkbox.closest('.card-body').querySelector('h5[data-price]');
        const price = parseFloat(priceElement.dataset.price);
        const qty = parseInt(document.querySelector('#menu_qty-' + checkbox.value).value);
        const itemPrice = price * qty;
        totalPrice += itemPrice;
    });

    // Get all the checked checkboxes for packages and calculate the total price
    const packageCheckboxes = document.querySelectorAll('input[name="paket_id[]"]:checked');
    packageCheckboxes.forEach(function(packageCheckbox) {
        const packagePriceElement = packageCheckbox.closest('.card-body').querySelector('h5[data-pricepaket]');
        const packagePrice = parseFloat(packagePriceElement.dataset.pricepaket);
        const packageQty = parseInt(document.querySelector('#paket_qty-' + packageCheckbox.value).value);
        const packageItemPrice = packagePrice * packageQty;
        totalPrice += packageItemPrice;
    });

    // Update the total price element
    const totalElement = document.querySelector('#total-button');
    totalElement.textContent = 'Rp. ' + totalPrice;

    // If the input is for a menu item, update the price element for the item
    if (input.name === 'menu_qty[]') {
        const priceElement = input.closest('.card-body').querySelector('h5[data-price]');
        const price = parseFloat(priceElement.dataset.price);
        const qty = parseInt(input.value);
        const newPrice = price * qty;
        priceElement.textContent = 'Rp. ' + newPrice;
    }

    // If the input is for a package item, update the price element for the item
    if (input.name === 'paket_qty[]') {
        const priceElement = input.closest('.card-body').querySelector('h5[data-pricepaket]');
        const price = parseFloat(priceElement.dataset.pricepaket);
        const qty = parseInt(input.value);
        const newPrice = price * qty;
        priceElement.textContent = 'Rp. ' + newPrice;
    }
    }

    // Listen for changes to menu item quantity inputs
    const menuQtyInputs = document.querySelectorAll('input[name="menu_qty[]"]');
    menuQtyInputs.forEach(function(input) {
    input.addEventListener('input', function() {
        updatePrice(this);
    });
    });

    // Listen for changes to package item quantity inputs
    const packageQtyInputs = document.querySelectorAll('input[name="paket_qty[]"]');
    packageQtyInputs.forEach(function(input) {
    input.addEventListener('input', function() {
        updatePrice(this);
    });
    });

    // Listen for changes to checkboxes
    const checkboxes = document.querySelectorAll('input[name="menu_id[]"], input[name="paket_id[]"]');
    checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        updatePrice(this);
    });
    });

</script>
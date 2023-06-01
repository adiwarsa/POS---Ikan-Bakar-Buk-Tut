<div class="table-responsive">
    @if (auth()->user()->role != 1)
	<table id="example" class="table table-striped table-bordered mb-4">
    @endif
    <table id="tablestockin" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
                <th>{{ __('Supplier') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Code') }}</th>
                <th>{{ __('Unit') }}</th>
                <th>{{ __('Date In') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Total Price') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($stock as $stockin)
			<tr>
				<td>{{ $loop->iteration }}</td>
                <td>{{ $stockin->supplier }}</td>
				<td>{{ $stockin->stock->name }}</td>
				<td>{{ $stockin->stock->code }}</td>
                <td>{{ $stockin->qty}} {{ $stockin->stock->type }}</td>
                <td>{{ $stockin->date_in }}</td>
                <td>Rp {{ number_format($stockin->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($stockin->total_price, 0, ',', '.') }}</td>
				<td>
                    <a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $stockin->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('stockin.edit', $stockin->id), 'info', 'edit') !!}
					{!! actionBtn(route('stockin.delete', $stockin->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
            <!-- Show Modal -->
            <div class="modal fade" id="showModal{{ $stockin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Info Stock {{ $stockin->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="show-form">
                            <div class="modal-body">
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Name" :value="__('Name')" />
                                    <x-input type="Name" name="Name" id="Name" :placeholder="__('Name')" :value="old('code', $stockin->stock->name)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Code" :value="__('Code')" />
                                    <x-input type="code" name="code" id="code" :placeholder="__('Code')" :value="old('code', $stockin->stock->code)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="qty" :value="__('Qty')" />
                                    <x-input type="qty" name="qty" id="qty" :placeholder="__('Qty')" :value="old('qty', $stockin->qty)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="price" :value="__('price')" />
                                    <x-input type="price" name="price" id="price" :placeholder="__('price')" :value="old('price', $stockin->price)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Total Price" :value="__('Total Price')" />
                                    <x-input type="total_price" name="total_price" id="total_price" :placeholder="__('total_price')" :value="old('total_price', $stockin->total_price)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="supplier" :value="__('supplier')" />
                                    <x-input type="supplier" name="supplier" id="supplier" :placeholder="__('supplier')" :value="old('supplier', $stockin->supplier)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Telp Supplier" :value="__('Telp Supplier')" />
                                    <x-input type="telp_supplier" name="telp_supplier" id="telp_supplier" :placeholder="__('telp_supplier')" :value="old('telp_supplier', $stockin->telp_supplier)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Nota" :value="__('Nota')" />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/stockin/'.$stockin->file) }}" alt="" width="250px">
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
            
                    </div>
                </div>
                </div>
            </div>
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('Belum ada data stock in') }}
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	<!-- Delete forms with javascript -->
	<form method="POST" class="d-none" id="delete-form">
		@csrf
		@method("DELETE")
	</form>

	{!! $stock->links() !!}
</div>



@push('js')
<script>
	function del(element) {
		event.preventDefault()
		let form = document.getElementById('delete-form');
		form.setAttribute('action', element.getAttribute('href'))
		swalConfirm('Apa kamu yakin ingin menghapus ?', `Kamu tidak bisa mengembalikannya`, 'Ya, Hapus!', () => {
			form.submit()
		})
	}

    // select the start date and end date input fields
    const startDateInput = document.querySelector('#start_date');
    const endDateInput = document.querySelector('#end_date');

    // disable the end date input field initially
    endDateInput.disabled = true;

    // listen for changes in the start date input field
    startDateInput.addEventListener('input', function() {
    // enable the end date input field if the start date is filled
    if (startDateInput.value !== '') {
        endDateInput.disabled = false;
    } else {
        endDateInput.disabled = true;
    }
    });
    //disable end date
    startDateInput.addEventListener('change', function() {
        endDateInput.disabled = false;
        endDateInput.min = startDateInput.value;
        });

    // get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // extract the start_date and end_date parameters
    const startDate = urlParams.get('start_date');
    const endDate = urlParams.get('end_date');


    // construct the title with the date range
    let title = `Warung Buk'Tut <br> Stock In Report <br>`;

    if (startDate && endDate) {
    title = `Warung Buk'Tut <br> Stock In Report <br> (${startDate} - ${endDate}) <hr>`;
    } else if (startDate) {
    title = `Warung Buk'Tut <br> Stock In Report <br> (${startDate}) <hr>`;
    }
        $(document).ready(function() {
    $('#tablestockin').DataTable( {
        dom: 'Bfrtip',
        buttons: [{
        extend: 'print',
        customize: function ( win ) {
            $(win.document.body).css('text-align', 'center'); // Set text alignment to center
            $(win.document.body).find('h1').css('text-align', 'center'); // Set title alignment to center
            $(win.document.body).find('table').css('font-size', '12px'); // Change font size of table content
            $(win.document.body).find('table').find('th:last-child, td:last-child').remove();
            const totalPrice = {{ $total }}; // Replace this with the total price calculated from your data
            const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(totalPrice);
            const priceRow = `<tr><td id="total" colspan="7" align="right">Total Pengeluaran :</td><td>${formattedPrice}</td></tr>`;
            $(win.document.body).find('table').append(priceRow);
            $(win.document.body)
            .find('#total')
            .css({
            'font-weight': 'bold',
            'font-size': '16px'
            });
            $(win.document.body).find('table').after('<div id="print-footer">Jimbaran, ' + new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) + '<br>Owner <hr>Buk Tut</div>');
            $(win.document.body).find('#print-footer').css({
                'text-align': 'center',
                'position': 'absolute',
                'font-size': '15px',
                'margin-top': '10px',
                'margin-left': 'auto',
                'margin-right': '0',
                'padding': '10px',
                'right' : '0'
                });
            $(win.document.body).find('h1').css('display', 'none');
                $(win.document.body)
                .prepend('<div style="text-align: center;">'+
                        '<h1 style="text-align:center;margin-top: 70px;">Ikan Bakar Buk`Tut </h1>'+
                        '<div style="text-align: center;">'+
                            '<p>Jl. Kendedes, Br. Langui Ungasan, Desa Ungasan, Badung, Bali.'+
                                '<h4>'+ (startDate && endDate ? 'Stock In Report <br> (' + startDate + ' - ' + endDate + ')' : (startDate ? 'Stock In Report <br> (' + startDate + ')' : 'Stock In Report')) + '<h4>'+
                        '</div>'+
                        '</div>');
        }
        }]
    });
    });
</script>
@endpush
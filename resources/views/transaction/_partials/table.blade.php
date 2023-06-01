<div class="table-responsive">
	@if (auth()->user()->role != 1)
	<table id="example" class="table table-striped table-bordered mb-4">
	@endif
	<table id="tabletransaction" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
                <th>{{ __('Code Transaction') }}</th>
                <th>{{ __('Customer Name') }}</th>
				<th>{{ __('Price') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($transaction as $tr)
			<tr>
				<td>{{ $loop->iteration }}</td>
                <td>{{ $tr->code }}</td>
                <td>{{ $tr->name }}</td>
				<td>Rp {{ number_format($tr->total_price, 0, ',', '.') }}</td>
				<td>
                    {!! actionBtn(route('transaction.print', $tr->id), 'success', 'printer', ["target='_blank'"]) !!}
                    <a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $tr->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('transaction.delete', $tr->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
            <!-- Show Modal -->
           
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('Belum ada data stock') }}
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>
	@forelse ($transaction as $tr )
	<div class="modal fade" id="showModal{{ $tr->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
			<h5 class="modal-title" id="exampleModalLabel">Info Transaction {{ $tr->code }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<hr>
			<div class="show-form">
					<div class="modal-body">
						<table class="table table-bordered customTable">
							<tr>
								<td colspan="10" class="text-center">Transaction</td>
							</tr>
							<tr>
								<td class="text-center"colspan="4">Name</td>
								<td class="text-center"colspan="4">Price</td>
                                <td class="text-center"colspan="4">Pay</td>
							</tr>
								<tr>
									<td class="text-center"colspan="4">{{ $tr->name }}</td>
									<td class="text-center"colspan="4">Rp {{ number_format($tr->total_price, 0, ',', '.') }}</td>
                                    <td class="text-center"colspan="4">Rp {{ number_format($tr->pay, 0, ',', '.') }}</td>
								</tr>
								<tr>
									<td colspan="10" class="text-center">Detail Menu</td>
								</tr>
								<tr>
									<td class="text-center">Menu</td>
									<td class="text-center" colspan="4">Qty</td>
                                    <td class="text-center" colspan="4">Price</td>
								</tr>
                                @forelse ($tr->menus as $food)
                                <tr>
                                        <td class="text-center">{{ $food->name }}</td>
                                        <td class="text-center"colspan="4">{{ $food->pivot->qty }} pcs</td>
                                        <td class="text-center"colspan="4">Rp {{ number_format( $food->pivot->qty * $food->price , 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <td colspan="10" class="text-center">No Menu</td>
                                @endforelse
                                <tr>
									<td colspan="10" class="text-center">Detail Paket</td>
								</tr>
								<tr>
									<td class="text-center">Paket</td>
									<td class="text-center" colspan="4">Qty</td>
                                    <td class="text-center" colspan="4">Price</td>
								</tr>
                                @forelse ($tr->pakets as $food)
                                <tr>
                                        <td class="text-center">{{ $food->name }}</td>
                                        <td class="text-center"colspan="4">{{ $food->pivot->qty }} pcs</td>
                                        <td class="text-center"colspan="4">Rp {{ number_format( $food->pivot->qty * $food->price , 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">No Paket</td>
                                </tr>
                                @endforelse
						</table>
					</div>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>
	@empty
		--
	@endforelse
	<!-- Delete forms with javascript -->
	<form method="POST" class="d-none" id="delete-form">
		@csrf
		@method("DELETE")
	</form>

	{!! $transaction->links() !!}
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
    let title = `Warung Buk'Tut <br> Transaction Report <br>`;

    if (startDate && endDate) {
    title = `Warung Buk'Tut <br> Transaction Report <br> (${startDate} - ${endDate}) <hr>`;
    } else if (startDate) {
    title = `Warung Buk'Tut <br> Transaction Report <br> (${startDate}) <hr>`;
    }
        $(document).ready(function() {
    $('#tabletransaction').DataTable( {
        dom: 'Bfrtip',
        buttons: [{
        extend: 'print',
        customize: function ( win ) {
            $(win.document.body).css('text-align', 'center'); // Set text alignment to center
            $(win.document.body).find('h1').css('text-align', 'center'); // Set title alignment to center
            $(win.document.body).find('table').css('font-size', '12px'); // Change font size of table content
            $(win.document.body).find('table').find('th:last-child, td:last-child').remove();
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
                                '<h4>'+ (startDate && endDate ? 'Transaction Report <br> (' + startDate + ' - ' + endDate + ')' : (startDate ? 'Transaction Report <br> (' + startDate + ')' : 'Transaction Report')) + '<h4>'+
                        '</div>'+
                        '</div>');
			const totalPrice = {{ $total }}; // Replace this with the total price calculated from your data
            const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(totalPrice);
            const priceRow = `<tr><td id="total" colspan="3" align="right">Total Pendapatan :</td><td>${formattedPrice}</td></tr>`;
            $(win.document.body).find('table').append(priceRow);
            $(win.document.body)
            .find('#total')
            .css({
            'font-weight': 'bold',
            'font-size': '16px'
            });
        }
        }]
    });
    });
</script>
@endpush
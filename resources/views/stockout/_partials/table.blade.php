<div class="table-responsive">
	@if (auth()->user()->role != 1)
	<table id="example" class="table table-striped table-bordered mb-4">
	@endif
	<table id="tablestockout" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Code') }}</th>
                <th>{{ __('Kg/Box') }}</th>
                <th>{{ __('Date Out') }}</th>
                <th>{{ __('Description') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($stockouts as $stockout)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $stockout->stock->name }}</td>
				<td>{{ $stockout->stock->code }}</td>
                <td>{{ $stockout->qty }}</td>
                <td>{{ $stockout->date_out}}</td>
                <td>{{ $stockout->description}}</td>

				<td>
                    <a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $stockout->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('stockout.edit', $stockout->id), 'info', 'edit') !!}
					{!! actionBtn(route('stockout.delete', $stockout->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
            <!-- Show Modal -->
            <div class="modal fade" id="showModal{{ $stockout->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Info Stock {{ $stockout->stock->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="show-form">
                            <div class="modal-body">
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Name" :value="__('Name')" />
                                    <x-input type="Name" name="Name" id="Name" :placeholder="__('Name')" :value="old('code', $stockout->stock->name)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Code" :value="__('Code')" />
                                    <x-input type="code" name="code" id="code" :placeholder="__('Code')" :value="old('code', $stockout->stock->code)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="qty" :value="__('Qty')" />
                                    <x-input type="qty" name="qty" id="qty" :placeholder="__('Qty')" :value="old('qty', $stockout->qty)" disabled />
                                </div>
								<div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="currentqty" :value="__('Current Qty')" />
                                    <x-input type="currentqty" name="currentqty" id="currentqty" :placeholder="__('currentqty')" :value="old('currentqty', $stockout->stock->qty)" disabled />
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
					{{ __('Belum ada data Stock Out') }}
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

	{!! $stockouts->links() !!}
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
    let title = `Warung Buk'Tut <br> Stock Out Report <br>`;

    if (startDate && endDate) {
    title = `Warung Buk'Tut <br> Stock Out Report <br> (${startDate} - ${endDate}) <hr>`;
    } else if (startDate) {
    title = `Warung Buk'Tut <br> Stock Out Report <br> (${startDate}) <hr>`;
    }
        $(document).ready(function() {
    $('#tablestockout').DataTable( {
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
                                '<h4>'+ (startDate && endDate ? 'Stock Out Report <br> (' + startDate + ' - ' + endDate + ')' : (startDate ? 'Stock Out Report <br> (' + startDate + ')' : 'Stock Out Report')) + '<h4>'+
                        '</div>'+
                        '</div>');
        }
        }]
    });
    });
</script>
@endpush
<div class="table-responsive">
	@if (auth()->user()->role != 1)
	<table id="example" class="table table-striped table-bordered mb-4">
	@endif
	<table id="tablestock" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Code') }}</th>
				<th>{{ __('Qty') }}</th>
				<th>{{ __('Unit') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($stock as $stck)
			<tr>
				@if($stck->qty > $stck->limits)
					<td>{{ $loop->iteration }}</td>
					<td>{{ $stck->name }} </td>
					<td>{{ $stck->code }}</td>
					<td>{{ $stck->qty }}</td>
					@if($stck->qtytype < 1)
						<td>{{ number_format($stck->qtytype * 1000, 0) }} Gram</td>
					@else
						<td>{{ number_format($stck->qtytype, 0) }} {{ $stck->type }}</td>
					@endif
				@elseif($stck->qty == 0)
					<td class="table-danger">{{ $loop->iteration }}</td>
					<td class="table-danger">{{ $stck->name }} </td>
					<td class="table-danger">{{ $stck->code }}</td>
					<td class="table-danger">{{ $stck->qty }}</td>
					<td class="table-danger">
						@if($stck->qtytype < 1)
							{{ number_format($stck->qtytype * 1000, 0) }} Gram
						@else
							{{ number_format($stck->qtytype, 0) }} {{ $stck->type }}
						@endif
					</td>
				@else
					<td class="table-warning">{{ $loop->iteration }}</td>
					<td class="table-warning">{{ $stck->name }} </td>
					<td class="table-warning">{{ $stck->code }}</td>
					<td class="table-warning">{{ $stck->qty }}</td>
					<td class="table-warning">
						@if($stck->qtytype < 1)
							{{ number_format($stck->qtytype * 1000, 0) }} Gram
						@else
							{{ number_format($stck->qtytype, 0) }} {{ $stck->type }}
						@endif
					</td>
				@endif
			
				<td>
					<a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $stck->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('stock.edit', $stck->id), 'info', 'edit') !!}
					{!! actionBtn(route('stock.delete', $stck->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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
	@forelse ($stock as $stck )
	<div class="modal fade" id="showModal{{ $stck->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
			<h5 class="modal-title" id="exampleModalLabel">Info Stock {{ $stck->name }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<hr>
			<div class="show-form">
					<div class="modal-body">
						<table class="table table-bordered customTable">
							<tr>
								<td colspan="4" class="text-center">Stock</td>
							</tr>
							<tr>
								<td class="text-center">Name</td>
								<td class="text-center">Code</td>
								<td class="text-center">Type</td>
								<td class="text-center">Pcs/type</td>
							</tr>
								<tr>
									<td class="text-center">{{ $stck->name }}</td>
									<td class="text-center">{{ $stck->code }}</td>
									<td class="text-center">{{ $stck->type }}</td>
									<td class="text-center">{{ $stck->limits }} pcs / {{ $stck->type }}</td>
								</tr>
								<tr>
									<td colspan="4" class="text-center">Stock Detail</td>
								</tr>
								<tr>
									<td class="text-center">Qty</td>
									@if($stck->qtytype < 1)
									<td class="text-center" colspan="3">{{ number_format($stck->qtytype * 1000, 0) }} Gram</td>
									@else
										<td class="text-center" colspan="3">{{ number_format($stck->qtytype, 0) }} {{ $stck->type }}</td>
									@endif
									
								</tr>
								<tr>
									<td class="text-center">Pcs</td>
									<td class="text-center" colspan="3">{{ $stck->qty }}  pcs  </td>
								</tr>
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
let title = `Warung Buk'Tut <br> Stock Report <br>`;

if (startDate && endDate) {
  title = `Warung Buk'Tut <br> Stock Report <br> (${startDate} - ${endDate}) <hr>`;
} else if (startDate) {
  title = `Warung Buk'Tut <br> Stock Report <br> (${startDate}) <hr>`;
}
	$(document).ready(function() {
  $('#tablestock').DataTable( {
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
							'<h4>'+ (startDate && endDate ? 'Stock Report <br> (' + startDate + ' - ' + endDate + ')' : (startDate ? 'Stock Report <br> (' + startDate + ')' : 'Stock Report')) + '<h4>'+
                      '</div>'+
                    '</div>');
	}
    }]
  });
});
</script>
@endpush
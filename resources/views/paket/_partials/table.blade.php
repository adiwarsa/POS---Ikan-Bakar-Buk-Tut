<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
				<th>{{ __('Price') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($pakets as $pk)
			<tr>
				<td>{{ $loop->iteration }}</td>
                <td>{{ $pk->name }}</td>
				<td>Rp {{ number_format($pk->price, 0, ',', '.') }}</td>
				<td>
                    <a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $pk->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('paket.delete', $pk->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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
	@forelse ($pakets as $pk )
	<div class="modal fade" id="showModal{{ $pk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
			<h5 class="modal-title" id="exampleModalLabel">Info Paket {{ $pk->name }}</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<hr>
			<div class="show-form">
					<div class="modal-body">
						<table class="table table-bordered customTable">
							<tr>
								<td colspan="7" class="text-center">Paket</td>
							</tr>
							<tr>
								<td class="text-center"colspan="4">Name</td>
								<td class="text-center"colspan="4">Price</td>
							</tr>
								<tr>
									<td class="text-center"colspan="4">{{ $pk->name }}</td>
									<td class="text-center"colspan="4">{{ $pk->price }}</td>
								</tr>
								<tr>
									<td colspan="7" class="text-center">Paket Detail</td>
								</tr>
								<tr>
									<td class="text-center">Menu</td>
									<td class="text-center" colspan="4">Qty</td>
                                    <td class="text-center" colspan="4">Gram</td>
								</tr>
                                @foreach ($pk->foods as $food)
                                <tr>
                                    
                                        <td class="text-center">{{ $food->name }}</td>
                                        <td class="text-center"colspan="4">{{ $food->pivot->qty }} pcs</td>
                                        @if ($food->stock->type == 'Kg')
                                        <td class="text-center"colspan="4">{{ ( $food->pivot->qty * $food->needqty ) * (10 / $food->stock->limits * 100)}} g</td>  
                                        @else
                                        <td class="text-center"colspan="4">{{ $food->stock->qtytype }} {{ $food->stock->type }}</td>  

                                            
                                        @endif
                                    </tr>
                                @endforeach
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

	{!! $pakets->links() !!}
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
</script>
@endpush
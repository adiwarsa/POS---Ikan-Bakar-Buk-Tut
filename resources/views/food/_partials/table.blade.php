<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
				<th>{{ __('Category') }}</th>
				<th>{{ __('Type') }}</th>
				<th>{{ __('Price') }}</th>
				<th>{{ __('Need') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($food as $fd)
			<tr>
				<td>{{ $loop->iteration }}</td>
                <td>{{ $fd->name }}</td>
				<td>@if ($fd->type == 'makanan')
					Food 
					@else
					Drink 
					@endif
				</td>
				<td>{{ $fd->jenis }}</td>
				<td>Rp {{ number_format($fd->price, 0, ',', '.') }}</td>
				<td>{{ $fd->needqty }} pcs {{ $fd->stock->name }}</td>
				<td>
                    <a type="button" class="btn-show btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal{{ $fd->id }}"><i class="bx bx-info-circle"></i></a>
					{!! actionBtn(route('food.edit', $fd->id), 'info', 'edit') !!}
					{!! actionBtn(route('food.delete', $fd->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
            <!-- Show Modal -->
            <div class="modal fade" id="showModal{{ $fd->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Info Stock {{ $fd->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr>
                    <div class="show-form">
                            <div class="modal-body">
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Name" :value="__('Name')" />
                                    <x-input type="Name" name="Name" id="Name" :placeholder="__('Name')" :value="old('code', $fd->name)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="price" :value="__('price')" />
                                    <x-input type="price" name="price" id="price" :placeholder="__('price')" :value="old('price', $fd->price)" disabled />
                                </div>
                                <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                                    <x-label for="Need" :value="__('Need')" />
                                    <x-input type="needqty" name="needqty" id="needqty" :placeholder="__('needqty')" :value="old('needqty', $fd->needqty . ' pcs ' . $fd->stock->name)" disabled />
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    {{ __('Close') }}
                                </button>
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
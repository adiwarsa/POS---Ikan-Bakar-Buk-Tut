<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Phone Number') }}</th>
				<th>{{ __('#') }}</th>	
				
			</tr>
		</thead>
		<tbody>
			@forelse($supplier as $spr)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $spr->nama }}</td>
				<td>{{ $spr->telp }}</td>
				<td>
					{!! actionBtn(route('supplier.edit', $spr->id), 'info', 'edit') !!}
					{!! actionBtn(route('supplier.delete', $spr->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>	
				
			</tr>
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('Belum ada data supplier') }}
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
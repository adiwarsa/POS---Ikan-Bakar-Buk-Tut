<div class="table-responsive">
	<table id="example" class="table table-striped table-bordered mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Email') }}</th>
				<th>{{ __('Phone') }}</th>
				<th>{{ __('Role') }}</th>
				<th>{{ __('Status') }}</th>
				<th>{{ __('#') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->phone }}</td>
				<td>
					<span class="badge bg-{{ $user->role == 1 ? 'success' : 'warning' }}">
						{{ $user->role == 1 ? __('Admin') : __('Pegawai') }}
					</span>
				</td>
				<td> @if($user->status == 'active')
					<form action="{{  route('users.updatestatus',['id'=>$user->id,'status'=>'inactive'])}}" method="POST">
						@csrf
						@method('put')
						<input type="text" name="id" value="{{ $user->id }}" hidden>
						<button type="submit" class="badge bg-success border-0"  value="inactive" type="submit">Active</button>
					</form>
				@else
					<form action="{{  route('users.updatestatus',['id'=>$user->id,'status'=>'active'])}}" method="POST">
						@csrf
						@method('put')
						<input type="text" name="id" value="{{ $user->id }}" hidden>
						<button type="submit" class="badge bg-danger border-0"  value="active" type="submit">Inactive</button>
					</form>
				@endif
				</td>
				<td>
					{!! actionBtn(route('users.edit', $user->id), 'info', 'edit') !!}
					{!! actionBtn(route('users.delete', $user->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('No data to display.') }}
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

	{!! $users->links() !!}
</div>

@push('js')
<script>
	function del(element) {
		event.preventDefault()
		let form = document.getElementById('delete-form');
		form.setAttribute('action', element.getAttribute('href'))
		swalConfirm('Are you sure ?', `You won't be able to revert this.`, 'Yes, delete it!', () => {
			form.submit()
		})
	}
</script>
@endpush
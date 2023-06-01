<x-app-layout title="Manajemen Menu">
	<x-breadcrumb
        :values="[__('Manajemen Menu'), __('Menu'),]">
    </x-breadcrumb>
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Manajemen Menu') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('food.create') }}" class="btn btn-primary" id="createButton" data-bs-toggle="modal" data-bs-target="#createModal">
					{{ __('Buat baru') }}
				</a>
			</div>

			@include('food._partials.table')

		</div>

		<!-- Modal -->
		<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="createModalLabel">Add Menu</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body text-center">
						<a href="{{ route('food.create') }}" class="btn btn-primary">Food</a>
						<a href="{{ route('food.createdrink') }}" class="btn btn-primary">Drink</a>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>

	</div>
</x-app-layout>
<script>
	$(document).ready(function() {
		$('#createButton').on('click', function(e) {
			e.preventDefault();
			$('#createModal').modal('show');
		});
	});
</script>
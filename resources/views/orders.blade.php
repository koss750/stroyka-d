@extends('layouts.alternative')


@section('canonical', '')


@section('additional_head')

@section('content')
<div class="container-fluid">
	<!-- Add Order -->
	<div class="modal fade" id="addOrderModalside">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create Project</h5>
					<button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						@csrf
						<div class="form-group">
							<label class="text-black font-w500">Project Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Deadline</label>
							<input type="date" class="form-control">
						</div>
						<div class="form-group">
							<label class="text-black font-w500">Client Name</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-primary">CREATE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="page-titles">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/orders">Заказы</a></li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<div id="bulkDeleteContainer" style="display: none;">
							<a href="#" id="bulkDeleteBtn" class="text-danger">
								<i class="fas fa-trash-alt"></i> Удалить
							</a>
						</div>
						<!-- Add any other buttons or elements you want here -->
					</div>
					<div class="table-responsive">
						@if($projects->isNotEmpty())

						<table class="table table-sm table-responsive-lg table-bordered border solid text-black">
							<thead>
								<tr>
									<th class="align-middle text-center checkbox-column">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="checkAll">
											<label class="custom-control-label" for="checkAll"></label>
										</div>
									</th>
									<th class="align-middle text-center order-column">Заказ</th>
									<th class="align-middle text-center">Дата</th>
									<th class="align-middle text-center minw200">Исполнители</th>
									<th class="align-middle text-center minw200">Сумма</th>
									<th class="align-middle text-center minw200">Файлы</th>
								</tr>
							</thead>
							<tbody id="orders">
							@foreach($projects as $project)
								<tr>
									<td class="py-2 text-center checkbox-column">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="customCheckBox{{ $project['id'] }}" required="">
											<label class="custom-control-label" for="customCheckBox{{ $project['id'] }}"></label>
										</div>
									</td>
									<td class="py-2 order-column">
										<a href="#">
											<strong>{{ $project['id'] }}</strong>
										</a> by <strong>{{ $project['title'] }}</strong> Смета <br />
									</td>
									<td class="py-2 text-center">{{ $project['created_at'] }}</td>
									<td class="py-2 text-center">
										<button class="btn btn-sm btn-primary assign-executor" data-project-id="{{ $project['id'] }}">Выбрать исполнителя</button>
									</td>
									<td class="py-2 text-center">{{ $project['payment_amount'] }} руб.</td>
									<td class="py-2 text-center">
										<div class="dropdown ms-auto text-centre">
										@if($project['filepath'])
											<div class="btn-link" data-bs-toggle="dropdown">
											<i class="fas fa-file-excel fa-lg" style="color: #217346;"></i>
											</div>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="{{ $project['filepath'] }}" download>Скачать</a>
											</div>
										@else
											<i class="fas fa-spinner fa-spin"></i>
										@endif
										</div>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						@else
							<div class="alert alert-info" role="alert">
								Заказов нет
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Disclaimer Modal -->
<div class="modal fade" id="disclaimerModal" style="z-index: 1000;" tabindex="-1" role="dialog" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disclaimerModalLabel">Важное уведомление</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Внимание! Все коммуникации вне этого веб-сайта будут наказываться по всей строгости закона Российской Федерации. Во избежание проблем, пожалуйста, осуществляйте все взаимодействия через наш сайт.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="acceptDisclaimer">Принять и продолжить</button>
            </div>
        </div>
    </div>
</div>

<!-- Executor Selection Modal -->
<div class="modal fade" id="executorModal" tabindex="-1" role="dialog" aria-labelledby="executorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="executorModalLabel">Выбрать исполнителя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="executorList"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const bulkDeleteContainer = $('#bulkDeleteContainer');
    const checkboxes = $('input[type="checkbox"]');
    const checkAll = $('#checkAll');

    function updateBulkDeleteVisibility() {
        const checkedBoxes = checkboxes.filter(':checked').not('#checkAll');
        bulkDeleteContainer.toggle(checkedBoxes.length > 0);
    }

    checkboxes.on('change', updateBulkDeleteVisibility);

    checkAll.on('change', function() {
        checkboxes.not(this).prop('checked', this.checked);
        updateBulkDeleteVisibility();
    });

    $('#bulkDeleteBtn').on('click', function(e) {
        e.preventDefault();
        const selectedIds = checkboxes.filter(':checked').not('#checkAll').map(function() {
            return $(this).attr('id').replace('customCheckBox', '');
        }).get();
        
        if (selectedIds.length > 0) {
            if (confirm('Вы точно хотите удалить выбранные заказы?')) {
                // Implement your delete logic here
                console.log('Deleting items:', selectedIds);
                // After deletion, you might want to refresh the table or remove the deleted rows
            }
        }
    });

    $('.assign-executor').on('click', function() {
        var projectId = $(this).data('project-id');
        $('#disclaimerModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#disclaimerModal').modal('show');

        // Remove any existing click handlers
        $('#acceptDisclaimer').off('click');
        
        $('#acceptDisclaimer').on('click', function() {
            $('#disclaimerModal').modal('hide');
            loadExecutors(projectId);
        });
    });

    // Ensure the close button works
    $('.modal .close, .modal .btn-secondary').on('click', function() {
        $(this).closest('.modal').modal('hide');
    });

    function loadExecutors(projectId) {
        $.ajax({
            url: '/api/projects/' + projectId + '/available-executors',
            method: 'GET',
            success: function(response) {
                var executorHtml = '<ul class="list-group">';
                response.executors.forEach(function(executor) {
                    executorHtml += '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                        executor.name +
                        '<button class="btn btn-sm btn-primary select-executor" data-executor-id="' + executor.id + '" data-project-id="' + projectId + '">Выбрать</button>' +
                        '</li>';
                });
                executorHtml += '</ul>';
                $('#executorList').html(executorHtml);
                $('#executorModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#executorModal').modal('show');
            },
            error: function() {
                alert('Ошибка при загрузке списка исполнителей');
            }
        });
    }

    $(document).on('click', '.select-executor', function() {
        var executorId = $(this).data('executor-id');
        var projectId = $(this).data('project-id');
        $.ajax({
            url: '/api/projects/' + projectId + '/assign-executor',
            method: 'POST',
            data: { executor_id: executorId },
            success: function(response) {
                $('#executorModal').modal('hide');
                alert('Исполнитель успешно назначен');
                // Optionally, refresh the page or update the UI
                location.reload();
            },
            error: function() {
                alert('Ошибка при назначении исполнителя');
            }
        });
    });
});
</script>
@endpush
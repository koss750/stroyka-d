@extends('layouts.alternative')


@section('canonical', '')


@section('additional_head')

@endsection

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
	@include('partials.tab-navigator', ['items' => [
        ['url' => '/my-orders', 'label' => 'Заказы'],
        ['url' => '/suppliers', 'label' => 'Исполнители'],
        ['url' => '/messages', 'label' => 'Мои переписки'],
        ['url' => '/profile', 'label' => 'Мои данные'],
    ]])
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
                    <div class="dropdown-item text-warning">
						<small><i class="fas fa-exclamation-triangle"></i> Файлы доступны для скачивания только в течение 30 дней с момента создания заказа.</small>
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
										<button class="btn btn-sm btn-primary assign-executor" data-project-id="{{ $project['id'] }}">Подобрать</button>
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
												<div class="dropdown-divider"></div>
												
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
<!-- executors -->
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
                <div class="form-group">
                    <label for="region-select">Выберите регион строительства:</label>
                    <select id="region-select" class="form-control">
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
                <button id="confirm-region" class="btn btn-primary mb-3">Подтвердить</button>
                <div id="executorList" class="row"></div>
                <div id="selected-executor" class="text-center" style="display: none;">
                    <img id="selected-executor-img" src="" alt="Executor" class="rounded-circle mb-3" width="150">
                    <h4 id="selected-executor-name"></h4>
                    <textarea id="message-to-executor" class="form-control mb-3" rows="4" placeholder="Введите текст для вашего исполнителя"></textarea>
                    <button id="send-message" class="btn btn-primary">Отправить сообщение</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- executors -->
<!-- Disclaimer Modal -->
<div class="modal fade" id="disclaimerModal" tabindex="-1" role="dialog" aria-labelledby="disclaimerModalLabel" aria-hidden="true">
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

@endsection

@push('scripts')
@endpush
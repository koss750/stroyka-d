@extends('layouts.alternative')

@section('title', 'Калькулятор Фундамента Ленточного')
@section('description', 'Рассчитайте стоимость ленточного фундамента')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Калькулятор Фундамента Ленточного</h2>
        <form id="stripFoundationForm" class="mt-4">
            @foreach($formFields as $field)
                <div class="form-group">
                    <label for="{{ $field->name }}">
                        <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="{{ $field->tooltip }}"></i>
                        {{ $field->label }}
                    </label>
                    @if($field->type == 'number')
                        <input type="number" class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" step="0.01" required data-excel-cell="{{ $field->excel_cell }}">
                    @elseif($field->type == 'select')
                        <select class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" required data-excel-cell="{{ $field->excel_cell }}">
                            <!-- Add options here -->
                        </select>
                    @else
                        <input type="text" class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" required data-excel-cell="{{ $field->excel_cell }}">
                    @endif
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mt-3">Рассчитать стоимость</button>
        </form>
    </div>
</div>
@endsection

@section('additional_scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('#stripFoundationForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            var excelData = {};
            
            formData.forEach(function(input) {
                var $input = $('[name="' + input.name + '"]');
                var excelCell = $input.data('excel-cell');
                if (excelCell) {
                    excelData[excelCell] = input.value;
                }
            });

            // Send excelData to the server for processing
            $.ajax({
                url: '/process-strip-foundation',
                method: 'POST',
                data: JSON.stringify(excelData),
                contentType: 'application/json',
                success: function(response) {
                    alert('Данные успешно отправлены для обработки.');
                },
                error: function() {
                    alert('Произошла ошибка при отправке данных.');
                }
            });
        });
    });
</script>
@endsection
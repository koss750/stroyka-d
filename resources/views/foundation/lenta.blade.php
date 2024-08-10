@extends('layouts.alternative')

@section('title', $page_title)
@section('description', $page_description)

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>{{ $page_title }}</h2>
        <form id="stripFoundationForm" class="mt-4">
            @foreach($formFields as $field)
                <div class="form-group" id="group-{{ $field->name }}" 
                     @if($field->depends_on) 
                         data-depends-on="{{ $field->depends_on }}" 
                         data-depends-value="{{ $field->depends_value }}" 
                         style="display: none;" 
                     @endif>
                    <label for="{{ $field->name }}">
                        <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="{{ $field->tooltip }}"></i>
                        {{ $field->label }}
                        @if(strpos($field->validation, 'required') !== false)
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                    @if(!empty($field->image))
                        <img src="{{ $field->image }}" alt="{{ $field->label }} image" class="img-helper">
                    @endif
                    @php
                        $isDisabled = strpos($field->validation, 'disabled') !== false ? 'disabled' : '';
                        $isRequired = strpos($field->validation, 'required') !== false ? 'required' : '';
                    @endphp
                    @if($field->type == 'number')
                        <input type="number" class="form-control light-placeholder" id="{{ $field->name }}" name="{{ $field->name }}" step="0.01" {{ $isRequired }} data-excel-cell="{{ $field->excel_cell }}" placeholder="{{ $field->default }}" {{ $isDisabled }}>
                    @elseif($field->type == 'select')
                        <select class="form-control light-placeholder" id="{{ $field->name }}" name="{{ $field->name }}" {{ $isRequired }} data-excel-cell="{{ $field->excel_cell }}" {{ $isDisabled }}>
                            @php
                                $options = explode(',', $field->options);
                                $firstOption = true;
                            @endphp
                            @foreach($options as $option)
                                @php
                                    list($optionLabel, $optionValue) = explode(':', $option);
                                @endphp
                                <option value="{{ $optionValue }}" {{ $firstOption ? 'selected' : '' }}>{{ $optionLabel }}</option>
                                @php
                                    $firstOption = false;
                                @endphp
                            @endforeach
                        </select>
                    @else
                        <input type="text" class="form-control light-placeholder" id="{{ $field->name }}" name="{{ $field->name }}" {{ $isRequired }} data-excel-cell="{{ $field->excel_cell }}" placeholder="{{ $field->default }}" {{ $isDisabled }}>
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

        // Handle dependent fields
        $('[data-depends-on]').each(function() {
            var $dependentField = $(this);
            var dependsOn = $dependentField.data('depends-on');
            var dependsValue = $dependentField.data('depends-value');

            $('#' + dependsOn).on('change', function() {
                if ($(this).val() == dependsValue) {
                    $dependentField.show();
                } else {
                    $dependentField.hide();
                }
            }).trigger('change'); // Trigger change to set initial state
        });

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

            // Send excelData to the Excel processing application
            $.ajax({
                url: 'http://tmp.стройка.com/foundation-full-file',
                method: 'GET',
                data: JSON.stringify({
                    foundation_type: 'lenta',
                    excel_data: excelData
                }),
                contentType: 'application/json',
                success: function(response) {
                    if (response.download_url) {
                        window.location.href = response.download_url;
                    } else {
                        alert('Ошибка при генерации файла.');
                    }
                },
                error: function() {
                    alert('Произошла ошибка при обработке данных.');
                }
            });
        });
    });
</script>
@endsection

@section('additional_styles')

@endsection
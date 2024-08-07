@extends('layouts.alternative')

@section('title', 'Калькулятор Монолитной Плиты')
@section('description', 'Рассчитайте стоимость монолитной плиты фундамента')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h2>Калькулятор Монолитной Плиты (MP)</h2>
        <form id="mpFoundationForm" class="mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Вид строения: дерево или камень"></i>
                            Вид строения дерево/камень
                        </label>
                        <select class="form-control" name="buildingType" required>
                            <option value="0">Дерево</option>
                            <option value="1">Камень</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="blindWidth">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ширина утепления под отмосток (не более 1200 мм)"></i>
                            Ширина утепления под отмосток (м)
                        </label>
                        <input type="number" class="form-control" id="blindWidth" name="blindWidth" step="0.01" max="1.2" required>
                    </div>
                    <div class="form-group">
                        <label for="innerCorners">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество внутренних углов от примыканий дополнительных плит"></i>
                            Количество внутренних углов от примыканий (шт)
                        </label>
                        <input type="number" class="form-control" id="innerCorners" name="innerCorners" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foundationArea">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Площадь фундаментной основной плиты"></i>
                            S плиты фундаментной основная (м2)
                        </label>
                        <input type="number" class="form-control" id="foundationArea" name="foundationArea" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="outerPerimeter">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Внешний периметр основной плиты"></i>
                            Внешний периметр основной плиты (м.п.)
                        </label>
                        <input type="number" class="form-control" id="outerPerimeter" name="outerPerimeter" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="mainSlabThickness">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина основной плиты"></i>
                            Толщина основной плиты (м)
                        </label>
                        <input type="number" class="form-control" id="mainSlabThickness" name="mainSlabThickness" step="0.01" required>
                    </div>
                </div>
            </div>

            <h4 class="mt-4">Основная плита</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Лежни арматуры 200х200/150х150"></i>
                            Лежни арматуры 200х200/150х150
                        </label>
                        <select class="form-control" name="reinforcementMesh" required>
                            <option value="0">200х200</option>
                            <option value="1">150х150</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="corners90">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество углов 90 гр"></i>
                            Количество углов 90 гр (шт)
                        </label>
                        <input type="number" class="form-control" id="corners90" name="corners90" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="corners45">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество углов 45 гр"></i>
                            Количество углов 45 гр (шт)
                        </label>
                        <input type="number" class="form-control" id="corners45" name="corners45" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="groundLevelDifference">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Перепад заложения (низ плиты от уровня грунта)"></i>
                            Перепад заложения (м)
                        </label>
                        <input type="number" class="form-control" id="groundLevelDifference" name="groundLevelDifference" step="0.01" required>
                    </div>
                </div>
            </div>

            <h4 class="mt-4">Лента №1</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Length">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Длина ленты №1"></i>
                            Длина ленты №1 (м.п.)
                        </label>
                        <input type="number" class="form-control" id="strip1Length" name="strip1Length" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Width">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ширина ленты №1"></i>
                            Ширина ленты №1 (м)
                        </label>
                        <input type="number" class="form-control" id="strip1Width" name="strip1Width" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Height">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Высота ленты №1"></i>
                            Высота ленты №1 (м)
                        </label>
                        <input type="number" class="form-control" id="strip1Height" name="strip1Height" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Corners90">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество углов 90 гр (без примыкающих)"></i>
                            Количество углов 90 гр (шт)
                        </label>
                        <input type="number" class="form-control" id="strip1Corners90" name="strip1Corners90" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Corners45">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество углов 45 гр (без примыкающих)"></i>
                            Количество углов 45 гр (шт)
                        </label>
                        <input type="number" class="form-control" id="strip1Corners45" name="strip1Corners45" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1Adjacencies">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество примыканий к плите"></i>
                            Количество примыканий к плите (шт)
                        </label>
                        <input type="number" class="form-control" id="strip1Adjacencies" name="strip1Adjacencies" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="strip1TopLevel">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Уровень верх ленты (относительно верха основной плиты)"></i>
                            Уровень верх ленты (м +/-)
                        </label>
                        <input type="number" class="form-control" id="strip1TopLevel" name="strip1TopLevel" step="0.01" required>
                    </div>
                </div>
            </div>

            <!-- Repeat similar structure for Лента №2 and Лента №3 -->

            <h4 class="mt-4">Проём №1</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="opening1Length">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Длина тех проема №1"></i>
                            Длина тех проема №1 (м.п.)
                        </label>
                        <input type="number" class="form-control" id="opening1Length" name="opening1Length" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="opening1Width">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ширина тех проема №1"></i>
                            Ширина тех проема №1 (м)
                        </label>
                        <input type="number" class="form-control" id="opening1Width" name="opening1Width" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Тип проема: основная/дополнительная"></i>
                            Тип проема
                        </label>
                        <select class="form-control" name="opening1Type" required>
                            <option value="0">Основная</option>
                            <option value="1">Дополнительная</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Repeat similar structure for Проём №2 and Проём №3 -->

            <h4 class="mt-4">Основание</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="buildingAreaOverlap">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Перепад по пятну застройки"></i>
                            Перепад по пятну застройки (м)
                        </label>
                        <input type="number" class="form-control" id="buildingAreaOverlap" name="buildingAreaOverlap" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sandBaseThickness">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина песчаного основания"></i>
                            Толщина песчаного основания (м)
                        </label>
                        <input type="number" class="form-control" id="sandBaseThickness" name="sandBaseThickness" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="crushedStoneBaseThickness">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина щебеночного основания"></i>
                            Толщина щебеночного основания (м)
                        </label>
                        <input type="number" class="form-control" id="crushedStoneBaseThickness" name="crushedStoneBaseThickness" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="concreteBaseThickness">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина подбетонного основания"></i>
                            Толщина подбетонного основания (м)
                        </label>
                        <input type="number" class="form-control" id="concreteBaseThickness" name="concreteBaseThickness" step="0.01" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="insulationThickness">
                            <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина утепления (ЭППС) 0,05/0,1"></i>
                            Толщина утепления (ЭППС) (м)
                        </label>
                        <input type="number" class="form-control" id="insulationThickness" name="insulationThickness" step="0.01" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Подбетонка гидроизоляция да/нет"></i>
                Подбетонка гидроизоляция
            </label>
            <select class="form-control" name="concreteWaterproofing" required>
                <option value="0">Нет</option>
                <option value="1">Да</option>
            </select>
        </div>
    </div>
</div>

<h4 class="mt-4">Инженерные коммуникации</h4>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="waterSupplyLength">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ввод ХВС длина от точки до края ф-та"></i>
                Ввод ХВС длина (м.п.)
            </label>
            <input type="number" class="form-control" id="waterSupplyLength" name="waterSupplyLength" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="sewerageLength">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ввод ЗСМ длина от точки до края ф-та"></i>
                Ввод ЗСМ длина (м.п.)
            </label>
            <input type="number" class="form-control" id="sewerageLength" name="sewerageLength" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="electricityLength">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Ввод СС длина от точки до края ф-та"></i>
                Ввод СС длина (м.п.)
            </label>
            <input type="number" class="form-control" id="electricityLength" name="electricityLength" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="sewagePoint1Length">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Вывод канализации точка 1 длина до точки"></i>
                Вывод канализации точка 1 (м.п.)
            </label>
            <input type="number" class="form-control" id="sewagePoint1Length" name="sewagePoint1Length" step="0.1" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="sewagePoint2Length">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Вывод канализации точка 2 длина до точки"></i>
                Вывод канализации точка 2 (м.п.)
            </label>
            <input type="number" class="form-control" id="sewagePoint2Length" name="sewagePoint2Length" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="sewagePoint3Length">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Вывод канализации точка 3 длина до точки"></i>
                Вывод канализации точка 3 (м.п.)
            </label>
            <input type="number" class="form-control" id="sewagePoint3Length" name="sewagePoint3Length" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Отмосток да/нет"></i>
                Отмосток
            </label>
            <select class="form-control" name="blind" required>
                <option value="0">Нет</option>
                <option value="1">Да</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="По периметру плит/ по габариту общему с учетом лент"></i>
                По периметру плит/ по габариту общему
            </label>
            <select class="form-control" name="blindPerimeter" required>
                <option value="0">По периметру плит</option>
                <option value="1">По габариту общему с учетом лент</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="blindLength">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Габаритная длина отмостка лент"></i>
                Габаритная длина отмостка лент (м.п.)
            </label>
            <input type="number" class="form-control" id="blindLength" name="blindLength" step="0.1" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="outerCorners">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество внешних углов"></i>
                Количество внешних углов (шт)
            </label>
            <input type="number" class="form-control" id="outerCorners" name="outerCorners" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="innerCorners">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Количество внутренних углов"></i>
                Количество внутренних углов (шт)
            </label>
            <input type="number" class="form-control" id="innerCorners" name="innerCorners" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="stripAdjacencyLength">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Длина между точками примыкания лент к плите"></i>
                Длина между точками примыкания лент к плите (м.п.)
            </label>
            <input type="number" class="form-control" id="stripAdjacencyLength" name="stripAdjacencyLength" step="0.1" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="foundationThickness">
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Толщина основания"></i>
                Толщина основания (м)
            </label>
            <input type="number" class="form-control" id="foundationThickness" name="foundationThickness" step="0.01" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fas fa-info-circle text-primary mr-1" data-toggle="tooltip" title="Основание песок/щебень"></i>
                Основание
            </label>
            <select class="form-control" name="foundationBase" required>
                <option value="0">Песок</option>
                <option value="1">Щебень</option>
            </select>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mt-3">Рассчитать стоимость</button>
</form>
</div>
</div>
@endsection

@section('additional_scripts')
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('#mpFoundationForm').on('submit', function(e) {
        e.preventDefault();
        // Here you can add the logic to calculate the cost based on the form inputs
        // and send the data to the server for processing
        alert('Форма отправлена. Здесь будет расчет стоимости.');
    });
});
</script>
@endsection
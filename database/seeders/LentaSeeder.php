<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LentaSeeder extends Seeder
{
    public function run()
    {
        // Inserting into excel_file_types
        DB::table('excel_file_types')->insert([
            'type' => 'foundation',
            'subtype' => 'lenta',
            'file' => 'foundation_lenta_tmp.xlsx'
        ]);

        // Array of associated costs
        $costs = [
            ['description' => 'Разбивка площадки с выносом осей', 'value' => '50', 'location_cell' => 'G13', 'location_sheet' => 'Смета'],
            ['description' => 'Разработка траншеи в ручную ширина ленты + 100мм с перемещением до 10 м без вывоза', 'value' => '1250', 'location_cell' => 'G14', 'location_sheet' => 'Смета'],
            ['description' => 'Зачистка дна траншеи вручную', 'value' => '150', 'location_cell' => 'G15', 'location_sheet' => 'Смета'],
            ['description' => 'Устройство песчаного основания ширина ленты + 100мм., толщиной мм', 'value' => '800', 'location_cell' => 'G16', 'location_sheet' => 'Смета'],
            ['description' => 'Укладка геотекстиля плотность 160', 'value' => '50', 'location_cell' => 'G17', 'location_sheet' => 'Смета'],
            ['description' => 'Устройство щебеночного основания ширина ленты + 100мм толщ мм', 'value' => '800', 'location_cell' => 'G18', 'location_sheet' => 'Смета'],
            ['description' => 'Монтаж опалубки', 'value' => '240', 'location_cell' => 'G21', 'location_sheet' => 'Смета'],
            ['description' => 'Устройство армокаркаса монолитного ростверка', 'value' => '17500', 'location_cell' => 'G29', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление детали "хомут"', 'value' => '12', 'location_cell' => 'G30', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление Д3 "УГОЛ"', 'value' => '7', 'location_cell' => 'G31', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление Д4 "УГОЛ 45"', 'value' => '7', 'location_cell' => 'G32', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление Д5 "крест"', 'value' => '7', 'location_cell' => 'G33', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление Д6 "Т"', 'value' => '7', 'location_cell' => 'G34', 'location_sheet' => 'Смета'],
            ['description' => 'Изготовление Д1 "Стойка"', 'value' => '3', 'location_cell' => 'G35', 'location_sheet' => 'Смета'],
            ['description' => 'Монтаж продухов', 'value' => '50', 'location_cell' => 'G37', 'location_sheet' => 'Смета'],
            ['description' => 'Бетонирование монолитного ростверка', 'value' => '5000', 'location_cell' => 'G38', 'location_sheet' => 'Смета'],
            ['description' => 'Горизонтальная гидроизоляция', 'value' => '450', 'location_cell' => 'G44', 'location_sheet' => 'Смета'],
            ['description' => 'Прием матералов на фундамент', 'value' => '4500', 'location_cell' => 'G48', 'location_sheet' => 'Смета'],
            ['description' => 'Расходный материал', 'value' => '3850', 'location_cell' => 'M13', 'location_sheet' => 'Смета'],
            ['description' => 'Песок карьерный', 'value' => '1300', 'location_cell' => 'M16', 'location_sheet' => 'Смета'],
            ['description' => 'Геотекстиль плотность 160 г/м2 ,50 м.п. шириной мм.', 'value' => '65', 'location_cell' => 'M17', 'location_sheet' => 'Смета'],
            ['description' => 'Щебень фр 20х40', 'value' => '3150', 'location_cell' => 'M18', 'location_sheet' => 'Смета'],
            ['description' => 'Доска 50х100 обр', 'value' => '16500', 'location_cell' => 'M21', 'location_sheet' => 'Смета'],
            ['description' => 'Шпилька М12 2000 мм', 'value' => '240', 'location_cell' => 'M22', 'location_sheet' => 'Смета'],
            ['description' => 'Шайба усиленная М12', 'value' => '360', 'location_cell' => 'M23', 'location_sheet' => 'Смета'],
            ['description' => 'Гайка М12', 'value' => '360', 'location_cell' => 'M24', 'location_sheet' => 'Смета'],
            ['description' => 'Гильза (Трубка изолирующая)', 'value' => '60', 'location_cell' => 'M25', 'location_sheet' => 'Смета'],
            ['description' => 'Гвоздь строительный 100 мм', 'value' => '160', 'location_cell' => 'M26', 'location_sheet' => 'Смета'],
            ['description' => 'Саморез черный по дереву усиленный 96 мм', 'value' => '390', 'location_cell' => 'M27', 'location_sheet' => 'Смета'],
            ['description' => 'Пленка п/э 200 мкр', 'value' => '100', 'location_cell' => 'M28', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M29', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.8 мм А240', 'value' => '70886.07595', 'location_cell' => 'M30', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M31', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M32', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M33', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M34', 'location_sheet' => 'Смета'],
            ['description' => 'Арматура д.12 мм А500С', 'value' => '61735.53719', 'location_cell' => 'M35', 'location_sheet' => 'Смета'],
            ['description' => 'Проволока вязальная', 'value' => '130000', 'location_cell' => 'M36', 'location_sheet' => 'Смета'],
            ['description' => 'Труба SN4 д.160 мм 2000 мм', 'value' => '1200', 'location_cell' => 'M37', 'location_sheet' => 'Смета'],
            ['description' => 'Труба SN4 д.160 мм 2000 мм', 'value' => '1200', 'location_cell' => 'M37', 'location_sheet' => 'Смета'],
            ['description' => 'Бетон В 25', 'value' => '7200', 'location_cell' => 'M38', 'location_sheet' => 'Смета'],
            ['description' => 'Опорная площадка "Стульчик"', 'value' => '11', 'location_cell' => 'M39', 'location_sheet' => 'Смета'],
            ['description' => 'диск отрезной д 125 мм', 'value' => '45', 'location_cell' => 'M41', 'location_sheet' => 'Смета'],
            ['description' => 'собка для степлера 1000 шт', 'value' => '55', 'location_cell' => 'M42', 'location_sheet' => 'Смета'],
            ['description' => 'нитка разметочная 150 м', 'value' => '170', 'location_cell' => 'M43', 'location_sheet' => 'Смета'],
            ['description' => 'Гидроизол', 'value' => '980', 'location_cell' => 'M44', 'location_sheet' => 'Смета'],
            ['description' => 'Мастика №24 мгтн (20 кг)', 'value' => '3968', 'location_cell' => 'M45', 'location_sheet' => 'Смета'],
            ['description' => 'Аренда а/м до 1,5 тн', 'value' => '3500', 'location_cell' => 'M49', 'location_sheet' => 'Смета'],
            ['description' => 'Аренда а/м до 8 тн', 'value' => '5000', 'location_cell' => 'M50', 'location_sheet' => 'Смета'],
            ['description' => 'Аренда JSB', 'value' => '18500', 'location_cell' => 'M51', 'location_sheet' => 'Смета'],
            ['description' => 'Аренда бетононасоса', 'value' => '23500', 'location_cell' => 'M52', 'location_sheet' => 'Смета'],
        ];


        // Inserting associated costs
        foreach ($costs as $cost) {
            DB::table('associated_costs')->insert([
                'filename' => "foundation_lenta_tmp.xlsx",
                'description' => $cost['description'],
                'location_cell' => $cost['location_cell'],
                'location_sheet' => $cost['location_sheet'],
                'value' => $cost['value'],
            ]);
        }
    }
}

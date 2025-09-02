<?php

namespace Database\Seeders;

use App\Actions\Slider\StoreSliderAction;
use App\Models\Slider;
use Exception;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require database_path('seeders/data/cafe.php');

        foreach ($data['sliders'] as $row) {
            /** @var Slider $row */
            $slider = StoreSliderAction::run([
                'title'       => $row['title'],
                'description' => $row['description'],
                'published'   => $row['published'],
            ]);

            try {
                $slider->addMedia($row['image'])
                       ->preservingOriginal()
                       ->toMediaCollection('image');
            } catch (Exception) {
                // do nothing
            }
        }
    }
}

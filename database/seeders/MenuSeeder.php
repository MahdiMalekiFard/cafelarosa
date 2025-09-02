<?php

namespace Database\Seeders;

use App\Actions\Menu\StoreMenuAction;
use App\Actions\MenuItem\StoreMenuItemAction;
use App\Actions\Opinion\StoreOpinionAction;
use Exception;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require database_path('seeders/data/cafe.php');

        foreach ($data['menus'] as $row) {

            $menu = StoreMenuAction::run([
                'published'   => $row['published'],
                'title'       => $row['title'],
                'description' => $row['description'],
            ]);

            try {
                $menu->addMedia($row['image'])
                     ->preservingOriginal()
                     ->toMediaCollection('image');
            } catch (Exception) {
                // do nothing
            }

            try {
                $menu->addMedia($row['left_image'])
                     ->preservingOriginal()
                     ->toMediaCollection('left_image');
            } catch (Exception) {
                // do nothing
            }

            try {
                $menu->addMedia($row['right_image'])
                     ->preservingOriginal()
                     ->toMediaCollection('right_image');
            } catch (Exception) {
                // do nothing
            }

            foreach ($data['menu-items'] as $rowItem) {
                StoreMenuItemAction::run([
                    'menu_id'       => $menu->id,
                    'title'         => $rowItem['title'],
                    'description'   => $rowItem['description'],
                    'published'     => $rowItem['published'],
                    'normal_price'  => $rowItem['normal_price'],
                    'special_price' => $rowItem['special_price'],
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Actions\Opinion\StoreOpinionAction;
use Illuminate\Database\Seeder;

class OpinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require database_path('seeders/data/cafe.php');

        foreach ($data['opinions'] as $row) {

            StoreOpinionAction::run([
                'user_name' => $row['user_name'],
                'company'   => $row['company'],
                'subject'   => $row['subject'],
                'comment'   => $row['comment'],
                'ordering'  => $row['ordering'],
                'published' => $row['published'],
            ]);
        }
    }
}

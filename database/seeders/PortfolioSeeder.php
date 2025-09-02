<?php

namespace Database\Seeders;

use App\Actions\Category\StoreCategoryAction;
use App\Actions\Portfolio\StorePortfolioAction;
use App\Enums\CategoryTypeEnum;
use App\Models\Portfolio;
use Exception;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require database_path('seeders/data/cafe.php');

        $category = StoreCategoryAction::run([
            'published'   => 1,
            'type'        => CategoryTypeEnum::PORTFOLIO,
            'title'       => 'From Beans to Bistro',
            'description' => 'Welcome to More Than a Meal — Welcome to an Experience',
            'body'        => '
<p>
    What sets us apart? It starts with our coffee. Sourced from ethically grown beans and roasted with precision,
    every cup tells the story of farmers, roasters, and baristas who care. But we’re not just about caffeine —
    our kitchen offers a thoughtfully curated menu that fuses local ingredients with international inspiration.
    From buttery croissants and gourmet sandwiches to comforting pastas and decadent pastries, there’s something
    here for every palate.
</p>
            ',
            'slug' => 'From-Beans-to-Bistro',
            'seo_title' => 'From Beans to Bistro',
            'seo_description' => 'Welcome to More Than a Meal — Welcome to an Experience',
        ]);

        foreach ($data['portfolios'] as $row) {

            /** @var Portfolio $portfolio */
            $portfolio = StorePortfolioAction::run([
                'title'           => $row['title'],
                'description'     => $row['description'],
                'slug'            => $row['slug'],
                'body'            => $row['body'],
                'seo_title'       => $row['seo_title'],
                'seo_description' => $row['seo_description'],
                'published'       => $row['published'],
            ]);

            $portfolio->categories()->sync([$category->id]);

            try {
                $portfolio->addMedia($row['image'])
                          ->preservingOriginal()
                          ->toMediaCollection('image');
            } catch (Exception) {
                // do nothing
            }
        }
    }
}

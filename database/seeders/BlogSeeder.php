<?php

namespace Database\Seeders;

use App\Actions\Blog\StoreBlogAction;
use App\Actions\Category\StoreCategoryAction;
use App\Enums\CategoryTypeEnum;
use Exception;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require database_path('seeders/data/cafe.php');

        $category = StoreCategoryAction::run([
            'published'       => 1,
            'type'            => CategoryTypeEnum::BLOG,
            'title'           => 'A Place for Everyone',
            'description'     => 'Our café restaurant is built on inclusivity. Whether you’re vegan, gluten-free, or just a picky eater (we don’t judge!), we’ve crafted a menu with options for all.',
            'body'            => '
<p>
    Our café restaurant is built on inclusivity. Whether you’re vegan, gluten-free, or just a picky eater (we don’t judge!),
    we’ve crafted a menu with options for all. We love seeing students typing away on laptops, couples sharing desserts,
    or parents introducing little ones to their first cappuccino.
</p>
            ',
            'slug'            => 'A-Place-for-Everyone',
            'seo_title'       => 'A Place for Everyone',
            'seo_description' => 'Our café restaurant is built on inclusivity. Whether you’re vegan, gluten-free, or just a picky eater (we don’t judge!), we’ve crafted a menu with options for all.',
        ]);

        foreach ($data['blogs'] as $row) {

            $blog = StoreBlogAction::run([
                'title'           => $row['title'],
                'description'     => $row['description'],
                'body'            => $row['body'],
                'slug'            => $row['slug'],
                'user_id'         => 1,
                'published'       => $row['published'],
                'seo_title'       => $row['seo_title'],
                'seo_description' => $row['seo_description'],
            ]);

            $blog->categories()->sync([$category->id]);

            try {
                $blog->addMedia($row['image'])
                     ->preservingOriginal()
                     ->toMediaCollection('image');
            } catch (Exception) {
                // do nothing
            }
        }
    }
}

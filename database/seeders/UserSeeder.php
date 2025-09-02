<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'admin',
            'mobile'   => '09151111111',
            'email'    => 'admin@gmail.com',
            'password' => 'password',
        ]);
        $admin->profile()->create([
            'user_id' => $admin->id,
        ]);
        $admin->syncRoles(RoleEnum::ADMIN->value);

        $user = User::create([
            'name'     => 'user',
            'mobile'   => '09151111112',
            'email'    => 'user@gmail.com',
            'password' => 'password',
        ]);
        $user->profile()->create([
            'user_id' => $user->id,
        ]);
        //        User::factory(8)->create()->each(function (User $user, int $index) {
        //            $imageUrl = '/images/client/0' . ($index + 1) . '.jpg';
        //            $user->addMediaFromUrl(loadTestImage(100))->toMediaCollection('avatar');
        //        });
    }
}

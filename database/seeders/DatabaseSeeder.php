<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $model = User::firstOrNew([
            'email' => 'filament@test.com'
        ]);

        $model->fill([
            'name'     => 'Filament Test',
            'password' => bcrypt('123456')
        ])->save();

        User::factory(30)->create();

        if (!DB::table('notifications')->count()) {

            foreach(range(1, 5) as $key) {
                Notification::make()->title('Test Message')->body("The number $key")->sendToDatabase($model);
            }
        }

    }
}

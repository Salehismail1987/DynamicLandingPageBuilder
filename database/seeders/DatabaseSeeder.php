<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteVisit;
use App\Models\WebsiteVisitor;
use App\Models\WebsiteClick;
use App\Models\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //NavBarSettingsSeeder::class,
        //NavBarItemsSeeder::class
        WebsiteVisitor::factory()->count(100)->create();
        WebsiteClick::factory()->count(200)->create();
        Like::factory()->count(500)->create();
        $this->call([
            NavBarItemsSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

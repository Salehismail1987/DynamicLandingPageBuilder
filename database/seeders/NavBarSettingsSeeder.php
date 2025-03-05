<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\navBarSettings;


class NavBarSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navBarSettings = new navBarSettings();
        $navBarSettings->enable = '1';
        $navBarSettings->enable_banner = '1';
        $navBarSettings->stick_to_top = '1';
        $navBarSettings->banner_color = 'transparent';
        $navBarSettings->text_color = '#000';
        $navBarSettings->font_family = '1';
        $navBarSettings->save();
    }
}

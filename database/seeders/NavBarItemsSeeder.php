<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\navBarItems;

class NavBarItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=5;$i++){
            $navBarSettings = new navBarItems();
            $navBarSettings->enable = '1';
            $navBarSettings->enable_banner = '0';
            $navBarSettings->text = 'Button '.$i;
            $navBarSettings->color = '#000';
            $navBarSettings->section = '0';
            $navBarSettings->link_type = 'link';
            $navBarSettings->address_id = '0';
            $navBarSettings->link_url = 'https://google.com';
            $navBarSettings->custom_form = '0';
            $navBarSettings->phone_no_call = '';
            $navBarSettings->phone_no_sms = '';
            $navBarSettings->email = '';
            $navBarSettings->use_default_text_color = '';
            $navBarSettings->save();
        }
    }
}

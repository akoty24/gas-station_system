<?php

namespace Database\Seeders;

use App\Models\WebsiteInfo;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class WebsiteInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_info = new WebsiteInfo();
        $website_info->logo = 'uploads/website_info/WhatsApp Image 2023-10-21 at 10.41.45 PM.jpeg';
        $website_info->title = 'Sample Title';
        $website_info->phone = '123-456-7890';
        $website_info->address = '123 Sample St, Sample City';
        $website_info->location = 'Miami, Florida USA';
        $website_info->whatsapp = 'sample_facebook';
        $website_info->twitter = 'sample_twitter';
        $website_info->snapchat = 'sample_snapchat';
        $website_info->instagram = 'sample_instagram';
        $website_info->email = 'sample@example.com';
        $website_info->save();
    }
}

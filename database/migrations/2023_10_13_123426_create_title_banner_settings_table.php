<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TitleBannerSetting;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_banner_settings', function (Blueprint $table) {
            $table->id();
            $table->text('title_slug');
            $table->enum('enable_theme_bg',['0','1'])->default('0');
            $table->timestamps();
        });

        $blog_title = new TitleBannerSetting();
        $blog_title->title_slug  = 'blog_title';
        $blog_title->save();

        $contact_info_block_title = new TitleBannerSetting();
        $contact_info_block_title->title_slug  = 'contact_info_block_title';
        $contact_info_block_title->save();

        $content_block_title = new TitleBannerSetting();
        $content_block_title->title_slug  = 'content_block_title';
        $content_block_title->save();

        $download_title = new TitleBannerSetting();
        $download_title->title_slug  = 'download_title';
        $download_title->save();

        $faq_title = new TitleBannerSetting();
        $faq_title->title_slug  = 'faq_title';
        $faq_title->save();

        $form_section_title = new TitleBannerSetting();
        $form_section_title->title_slug  = 'form_section_title';
        $form_section_title->save();

        $gallery_posts_title = new TitleBannerSetting();
        $gallery_posts_title->title_slug  = 'gallery_posts_title';
        $gallery_posts_title->save();

        $gallery_slider_title = new TitleBannerSetting();
        $gallery_slider_title->title_slug  = 'gallery_slider_title';
        $gallery_slider_title->save();

        $gallery_tiles_title = new TitleBannerSetting();
        $gallery_tiles_title->title_slug  = 'gallery_tiles_title';
        $gallery_tiles_title->save();

        $gallery_videos_title = new TitleBannerSetting();
        $gallery_videos_title->title_slug  = 'gallery_videos_title';
        $gallery_videos_title->save();

        $links_title = new TitleBannerSetting();
        $links_title->title_slug  = 'links_title';
        $links_title->save();

        $news_feed_title = new TitleBannerSetting();
        $news_feed_title->title_slug  = 'news_feed_title';
        $news_feed_title->save();

        $news_posts_title = new TitleBannerSetting();
        $news_posts_title->title_slug  = 'news_posts_title';
        $news_posts_title->save();

        $reviews_staff_title = new TitleBannerSetting();
        $reviews_staff_title->title_slug  = 'reviews_staff_title';
        $reviews_staff_title->save();

        $staff_products_promos_title = new TitleBannerSetting();
        $staff_products_promos_title->title_slug  = 'staff_products_promos_title';
        $staff_products_promos_title->save();

        $schedule_title = new TitleBannerSetting();
        $schedule_title->title_slug  = 'schedule_title';
        $schedule_title->save();

        $set_hours_title = new TitleBannerSetting();
        $set_hours_title->title_slug  = 'set_hours_title';
        $set_hours_title->save();

        $seo_title = new TitleBannerSetting();
        $seo_title->title_slug  = 'seo_title';
        $seo_title->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('title_banner_settings');
    }
};

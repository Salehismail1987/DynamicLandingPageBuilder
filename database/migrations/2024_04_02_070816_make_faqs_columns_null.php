<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE `faqs` CHANGE `question_font_size` `question_font_size` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `question_text_color` `question_text_color` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `question_font_family` `question_font_family` INT(11) NULL DEFAULT NULL, CHANGE `answer_font_size` `answer_font_size` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `answer_text_color` `answer_text_color` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `answer_font_family` `answer_font_family` INT(11) NULL DEFAULT NULL;
        ');
        DB::statement('ALTER TABLE `content_block_links` CHANGE `content_title_color` `content_title_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `content_title_font_size` `content_title_font_size` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `content_title_font_family` `content_title_font_family` INT(11) NULL DEFAULT NULL;
        ');
        DB::statement('ALTER TABLE `content_block_links` CHANGE `content_desc_color` `content_desc_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `content_desc_font_size` `content_desc_font_size` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `content_desc_font_family` `content_desc_font_family` INT(11) NULL DEFAULT NULL;
        ');
        DB::statement('ALTER TABLE `contact_forms` CHANGE `form_title_color` `form_title_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `form_title_size` `form_title_size` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `form_title_font_family` `form_title_font_family` INT(11) NULL DEFAULT NULL;
        ');
        DB::statement('ALTER TABLE `news_posts` CHANGE `font_family` `font_family` INT(11) NULL DEFAULT NULL, CHANGE `post_title_color` `post_title_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `post_title_size` `post_title_size` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `post_desc_font_size` `post_desc_font_size` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL, CHANGE `desc_font_family` `desc_font_family` INT(11) NULL DEFAULT NULL, CHANGE `post_desc_color` `post_desc_color` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

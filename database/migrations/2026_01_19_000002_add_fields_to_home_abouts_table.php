<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            $cols = [
                'section_label','title_main','description_main','tagline','description_second','visi_description',
                'title_1','title_2','title_3','title_4',
                'fourth_title_1','fourth_title_2','fourth_title_3',
                'support_service_1','support_service_2','support_service_3','support_service_4'
            ];
            foreach ($cols as $col) {
                if (! Schema::hasColumn('home_abouts', $col)) {
                    $table->text($col)->nullable()->after('id');
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            $table->dropColumn([
                'section_label','title_main','description_main','tagline','description_second','visi_description',
                'title_1','title_2','title_3','title_4',
                'fourth_title_1','fourth_title_2','fourth_title_3',
                'support_service_1','support_service_2','support_service_3','support_service_4'
            ]);
        });
    }
};

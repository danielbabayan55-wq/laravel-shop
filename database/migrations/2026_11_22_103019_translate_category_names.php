<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $names = [
            'Электроника' => 'Էլեկտրոնիկա',
            'Одежда'      => 'Հագուստ',
            'Книги'       => 'Գրքեր',
            'Дом'         => 'Տուն',
        ];

        foreach ($names as $old => $new) {
         DB::table('categories')->where('name', $old)->update(['name'=> $new]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

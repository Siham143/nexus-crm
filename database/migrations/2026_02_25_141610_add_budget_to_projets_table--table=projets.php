<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
   public function up()
{
    Schema::table('projets', function (Blueprint $table) {
        $table->decimal('budget', 15, 2)->default(0); // كنزيدو خانة الفلوس
    });
}

    
    public function down(): void
    {
        //
    }
};

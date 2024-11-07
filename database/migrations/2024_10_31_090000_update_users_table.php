<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();  
            $table->enum('gender', ['male', 'female'])->nullable(); 
            $table->string('avatar')->default('NULL'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');   
            $table->dropColumn('gender');   
            $table->dropColumn('avatar');  
        });
    }
    
};

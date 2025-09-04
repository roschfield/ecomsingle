<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('collection_id')->constrained('collections')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price',10,2);
            $table->boolean('is_active')->default(true);
            $table->boolean('in_stock')->default(true);
            $table->integer('stock_quantity')->default(0)->after('in_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
    
    
};



// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//    public function up(): void
// {
//     Schema::table('products', function (Blueprint $table) {
//         $table->integer('stock_quantity')->default(0)->after('in_stock');
//     });
// }

// public function down(): void
// {
//     Schema::table('products', function (Blueprint $table) {
//         $table->dropColumn('stock_quantity');
//     });
// }

// };

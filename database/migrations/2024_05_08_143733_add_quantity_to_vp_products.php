<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToVpProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vp_products', function (Blueprint $table) {
            $table->integer('prod_quantity')->default(0); // Thêm trường số lượng với giá trị mặc định là 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vp_products', function (Blueprint $table) {
            $table->dropColumn('prod_quantity'); // Xóa trường số lượng nếu rollback migration
        });
    }
}

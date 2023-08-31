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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id')->unsigned(); /* unsigned()=整数型に対し負の値を持たないこと指定 */
            $table->string('title', 100);
            $table->date('due_date');
            $table->integer('status')->default(1);
            $table->timestamps();

            // 外部キー制約の設定
            $table->foreign('folder_id')->references('id')->on('folders');
            
            // foreign()='folder_id' という名前の列に外部キー制約を設定するためのメソッド この列の値は別のテーブルの主キーと関連付けられる
            // references()=外部キーが参照するテーブルのカラムを指定するためのメソッド 'folder_id' 列の値は 'folders' テーブル内の 'id' 列の値と一致する必要
            // on()=外部キーが参照するテーブルの名前を指定するためのメソッド 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

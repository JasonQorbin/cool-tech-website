<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


//This migration creates the database structure from scratch. It expects an empty database. Therefore,
// reversing the migration will destroy the database and all the data within.
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Create the articles table, without the category foreign key (because the category table doesn't exist yet).
        Schema::create('articles', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('category_name', 255)->default('Unassigned');
            $table->text('title')->nullable(false);
            $table->text('content')->default("");
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->timestamp('updated_at')->nullable(false)->useCurrent();
            $table->index(['created_at', 'category_name']);
        });

        //Create the tags table
        Schema::create('tags', function (Blueprint $table) {
            $table->string('name', 255)->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->timestamp('updated_at')->nullable(false)->useCurrent();
            $table->primary('name');
        });

        //Create joining table for many-to-many relationship between articles and tags.
        Schema::create('article_tag_joins', function (Blueprint $table) {
            $table->mediumInteger('article_id')->unsigned()->nullable(false);
            $table->string('tag_name', 255)->nullable(false);
            $table->primary(['article_id', 'tag_name']);

            $table->foreign('article_id')->references('id')->on('articles')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('tag_name')->references('name')->on('tags')
                ->restrictOnDelete()->cascadeOnUpdate();
        });

        //Create categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->string('name', 255)->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->timestamp('updated_at')->nullable(false)->useCurrent();
            $table->primary('name');
        });

        //Insert the standard categories per the business rules.
        //These must exist for the foreign key constraints to work so we insert them here and not in a seeder.
        DB::table('categories')->insert(['name' => 'Unassigned']);
        DB::table('categories')->insert(['name' => 'Tech news']);
        DB::table('categories')->insert(['name' => 'Software reviews']);
        DB::table('categories')->insert(['name' => 'Hardware reviews']);
        DB::table('categories')->insert(['name' => 'Opinion pieces']);

        //Add foreign key constraint to the articles table linking to the categories table.
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('category_name')->references('name')->on('categories')
                ->restrictOnDelete()->cascadeOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //First delete data where a constraint would prevent further actions
        //Then drop each of the tables
        DB::table('article_tag_joins')->truncate();
        Schema::drop('article_tag_joins');
        DB::table('tags')->truncate();
        Schema::drop('tags');
        DB::table('articles')->truncate();
        Schema::drop('articles');
        Schema::drop('categories');
    }
};

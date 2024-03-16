<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Add a 'role' column to the users table.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable(false)->default('user');
        });

        //Set all existing users to the normal user role.
        DB::table('users')->update(['role' => 'user']);

        //Make the existing "admin" user an admin or add them if they don't exist.
        //This is an upsert for testing purposes because there is likely already an admin user.
        //When running the website in prod all the migrations will run at once and we created the admin user here.
        DB::table('users')->upsert(
            [   'name' => 'admin',
                'role' => 'admin',
                'email'=> 'admin@admin.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now()],
            ['name' => 'admin'],
            ['role']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('type', 20)->default("USER");
            $table->string('status', 20)->default("ACTIVE");
            $table->timestamp("last_login_time")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $data = array(
            [
                'name' => 'ADMINISTRATOR',
                'email' => 'admin@administrator.com',
                'password' => Hash::make("FusionTech123$"),
                'type' => 'ADMIN',
                'status' => 'ACTIVE',
            ],
        );

        foreach($data as $datum){
            $adminUser = new User();
            $adminUser->name = $datum['name'];
            $adminUser->email = $datum['email'];
            $adminUser->password = $datum['password'];
            $adminUser->type = $datum['type'];
            $adminUser->status = $datum['status'];

            $adminUser->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

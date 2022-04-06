<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->String('app_name', 50)->required();
            $table->String('app_section', 50)->required();
            $table->String('app_field', 50)->required();
            $table->String('app_value_1', 50)->required();
            $table->string('app_value_2', 50)->nullable();
            $table->string('app_value_3', 50)->nullable();
            $table->string('added_by', 25)->require()->default('SYSTEM');
            $table->string('app_setting_description', 255)->required();
            $table->timestamps();
        });

        $data = array(
            [
                'app_name' => 'APP',
                'app_section' => 'DRIVER',
                'app_field' => 'SHARE',
                'app_value_1' => '0.10',
                'added_by' => 'USER',
                'app_setting_description' => 'Share of the driver of the net income. Currently 10% of the net income'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'TAX',
                'app_field' => 'RATE',
                'app_value_1' => '0.12',
                'added_by' => 'USER',
                'app_setting_description' => 'Used for Tax Deduction 12%'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'TRUCK',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON-SERVICE',
                'app_setting_description' => 'This settings was used by the TRUCK MODULE for the truck status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'TRUCK',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON A TRIP',
                'app_setting_description' => 'This settings was used by the TRUCK MODULE for the truck status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'TRUCK',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON MAINTENANCE',
                'app_setting_description' => 'This settings was used by the TRUCK MODULE for the truck status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'DRIVER',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON A TRIP',
                'app_setting_description' => 'This settings was used by the DRIVER MODULE for the driver status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'DRIVER',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON-LEAVE',
                'app_setting_description' => 'This settings was used by the DRIVER MODULE for the driver status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'DRIVER',
                'app_field' => 'STATUS',
                'app_value_1' => 'ON-SERVICE',
                'app_setting_description' => 'This settings was used by the DRIVER MODULE for the driver status'
            ],
            [
                'app_name' => 'APP',
                'app_section' => 'DRIVER',
                'app_field' => 'POSITION',
                'app_value_1' => 'DRIVER',
                'app_setting_description' => 'This settings was used by the DRIVER MODULE for the driver position'
            ]
        );

        foreach($data as $datum){
            $setting = new Setting();
            $setting->app_name = $datum['app_name'];
            $setting->app_section = $datum['app_section'];
            $setting->app_field = $datum['app_field'];
            $setting->app_value_1 = $datum['app_value_1'];
            $setting->app_setting_description = $datum['app_setting_description'];

            $setting->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRecordsInPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $entries = DB::table('packages')->insert(array(
            array('name' => 'Smart Sugar Health Check-up', 'description' => 'Diabetes is the silent killer and it can strike without warning. Diabetes afflicts more than 200 million people, worldwide. One in 8 people suffer from diabetes. The comprehensive smart sugar package at CARE Hospitals is designed especially for diabetes patients. The package helps to identify the sugar levels of the body and its complications limiting its progress.', 'price' => '575', 'discount' => null, 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '2', 'is_profile_test' => false),
            array('name' => 'Gynaecology Check-up', 'description' => 'Breast and cervical cancers are two major cancers among Indian women. One in every 8 women suffer from these diseases. Early detection is the only key to increase the chances of cure. Hence regular health check-ups are very important for women. Even in the absence of signs and symptoms, many doctors recommend routine, yearly health check-ups for all females.', 'price' => '950', 'discount' => null, 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '3', 'is_profile_test' => false),
            array('name' => 'Smart Thyroid Health Check-up', 'description' => 'Smart thyroid health check-up package is designed for patients with hyper or hypo thyroidism. Thyroidism most often affects middle-aged and older women but anyone can develop the condition, including infants. People with a family history of thyroid disorders are advised to have a regular check-up. The thyroid glands are one of the endocrine glands, which produce hormones. These hormones control the rate of many activities in the body. These blood tests help in managing and identifying whether the thyroid glands hormone production is normal, overactive or underactive.', 'price' => '1100', 'discount' => null, 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '1', 'is_profile_test' => true),
            array('name' => 'Smart Kidney Health Check-up', 'description' => 'There are millions of people who are at increased risk of getting kidney disease, and most of them dont know it. CARE Hospitals smart kidney check-up is a preventive health check-up package for early detection of kidney diseases. Kidney disease can be found and treated early to prevent more serious complications. These tests and diagnoses will help the doctor in monitoring the condition of the kidney.', 'price' => '1100', 'discount' => null, 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '2', 'is_profile_test' => false),
            array('name' => 'Smart Lung Health Check-up', 'description' => 'The main reason lung cancer and pulmonary disease being deadly is that it’s caught late; according to experts 84% of patients are diagnosed only after the cancer has spread beyond the lungs. The only key to early detection is to have a regular check-up at least once a year and if you have a family history then it is a must.', 'price' => '1500', 'discount' => null, 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '3', 'is_profile_test' => true),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

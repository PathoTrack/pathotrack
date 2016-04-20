<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRecordsInTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $entries = DB::table('tests')->insert(array(
            array('name' => 'X-Ray', 'description' => 'X-ray is a well-established technology that uses minimal doses of radiation to capture images of bone and high density tissue in the body. An X-ray machine will be used to take an image of the area of interest inside your body (chest X-ray, abdominal X-ray, extremity/bone X-ray, etc.).', 'price' => '575', 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '2', 'is_profile_test' => false),
            
            array('name' => 'Ultrasound', 'description' => 'Ultrasound is a safe procedure that uses soundwaves to produce an image. For the exam, a sonographer applies gel to the skin. This gel is necessary for producing high quality images. The sonographer then passes the transducer over the targeted area to view the images on a video monitor.', 'price' => '950', 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '3', 'is_profile_test' => true),

            array('name' => 'CT Scans', 'description' => 'A CT scan is a test that your doctor may order to view an area of interest in cross-section. A good analogy would be to think of your body as being a loaf of bread and every slice would be a picture on the CT exam. The test involves you lying on a table and moving in and out of a donut shaped hole. X-rays and computers generate the final images for a Radiologist to view or read.', 'price' => '1100', 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '1', 'is_profile_test' => false),

            array('name' => 'Bone Density Testing', 'description' => 'Bone density testing is used to determine a woman’s risk of osteoporosis. This safe, painless procedure uses small amounts of radiation to measure bone density. As with breast cancer, early detection is important in the prevention and treatment of osteoporosis.', 'price' => '1100', 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '2', 'is_profile_test' => true),

            array('name' => 'Gastrointestinal X-Rays', 'description' => 'A series of gastrointestinal x-rays enables physicians to observe the structure and functioning of the tissue and organs related to your eating and digestive system. The tests can help your doctor to detect ulcers, polyps, tumors, hernias, reflux disorders, Crohns disease, appendicitis and other bowel diseases.', 'price' => '1500', 'is_half_day_fasting_applicable' => false, 'special_instructions' => null, 'number_of_visits_required' => '3', 'is_profile_test' => true),
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

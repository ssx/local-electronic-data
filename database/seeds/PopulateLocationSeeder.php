<?php

use Illuminate\Database\Seeder;

class PopulateLocationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parking_locations')->insert(array(

            array("location_id" => "C07311", "woeid" => "24875484", "city" => "Southampton", "name" => "Grosvenor Square","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07311.jpg"),
            array("location_id" => "C07312", "woeid" => "24875484", "city" => "Southampton", "name" => "Marlands","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07312.jpg"),
            array("location_id" => "C07313", "woeid" => "24875484", "city" => "Southampton", "name" => "West Bay","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07313.jpg"),
            array("location_id" => "C07314", "woeid" => "24875484", "city" => "Southampton", "name" => "West Park","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07314.jpg"),
            array("location_id" => "C07315", "woeid" => "24875484", "city" => "Southampton", "name" => "Leisure World","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07315.jpg"),
            array("location_id" => "C07316", "woeid" => "24875484", "city" => "Southampton", "name" => "Eastgate Street","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07316.jpg"),
            array("location_id" => "C07317", "woeid" => "24875484", "city" => "Southampton", "name" => "Lime Street","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07317.jpg"),
            array("location_id" => "C07318", "woeid" => "24875484", "city" => "Southampton", "name" => "Charlotte Place","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07318.jpg"),
            array("location_id" => "C07321", "woeid" => "24875484", "city" => "Southampton", "name" => "Gloucester Square","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07321.jpg"),
            array("location_id" => "C07322", "woeid" => "24875484", "city" => "Southampton", "name" => "College Street","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07322.jpg"),
            array("location_id" => "C07323", "woeid" => "24875484", "city" => "Southampton", "name" => "Bargate Centre","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07323.jpg"),
            array("location_id" => "C07324", "woeid" => "24875484", "city" => "Southampton", "name" => "Portland Terrace","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07324.jpg"),
            array("location_id" => "C07325", "woeid" => "24875484", "city" => "Southampton", "name" => "West Quay Podium","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07325.jpg"),
            array("location_id" => "C07326", "woeid" => "24875484", "city" => "Southampton", "name" => "West Quay Multi-Storey","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07326.jpg"),
            array("location_id" => "C07327", "woeid" => "24875484", "city" => "Southampton", "name" => "Bedford Place MSCP","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07327.jpg"),
            array("location_id" => "C07328", "woeid" => "24875484", "city" => "Southampton", "name" => "IKEA","image_url" => "http://southampton.romanse.org.uk/staticfiles/car%20parks/C07328.jpg")

        ));
    }

}

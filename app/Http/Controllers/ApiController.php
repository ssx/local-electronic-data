<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | API Controller
    |--------------------------------------------------------------------------
    |
    |
    */


    /**
     * @Get("/v1/locations")
     */
    public function getLocations()
    {
        // http://led-api.dev:8000/v1/locations
        return Response::json(Location::all());
    }


    /**
     * @Get("/v1/locations/{woeid}", as="woeid")
     */
    public function getLocationByWoeid($woeid)
    {
        /*
         * http://led-api.dev:8000/v1/locations/24875484
         * SELECT lid,name,image_url FROM data_parking.statistic_parking_locations WHERE woeid = 'woeid' ORDER BY name
         */
        return Response::json(Location::where(array("woeid", "=", $woeid)));
    }


    /**
     * @Get("/v1/locations/{woeid}/{id}", as="woeid,$location_id")
     */
    public function getDataForLocationById($woeid, $location_id)
    {
        /*
         * http://led-api.dev:8000/v1/locations/24875484/C07311
         *
         * SELECT city,name,image_url FROM data_parking.statistic_parking_locations WHERE lid = 'id' LIMIT 1
         *   "status" => 200,
         *   "generated" => date("r"),
         *   "name" => stripslashes($name),
         *   "image" => stripslashes(stripslashes($image_url)),
         *   "updated" => $timestamp,
         *   "age" => $age = time()-$timestamp,
         *   "state" => stripslashes($state),
         *   "capacity" => $capacity,
         *   "used" => $used,
         *   "free_00" => $free_00,
         *   "free_30" => $free_30,
         *   "free_60" => $free_60
         *
        */
    }
}

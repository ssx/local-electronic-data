<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;
use App\Models\LocationData;
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
     * @Get("/v1/heartbeat")
     */
    public function getHeartbeat()
    {
        $aryReturn = [
            "status" => 200
        ];
        return Response::json($aryReturn);
    }


    /**
     * @Get("/v1/overview")
     */
    public function getOverview()
    {
        $aryReturn = [];
        foreach (Location::all() as $objLocation)
        {
            $objLocationData = LocationData::whereRaw('location_id = ?', array($objLocation->location_id))->orderBy('created_at', 'desc')->take(1)->get();
            $aryReturn[] = ["meta" => $objLocation, "data" => $objLocationData[0]];
        }
        return Response::json($aryReturn);
    }


    /**
     * @Get("/v1/locations")
     */
    public function getLocations()
    {
        return Response::json(Location::all());
    }


    /**
     * @Get("/v1/locations/{woeid}", as="woeid")
     */
    public function getLocationByWoeid($woeid)
    {
        return Response::json(Location::where("woeid", "=", $woeid)->get());
    }


    /**
     * @Get("/v1/locations/{woeid}/{id}", as="woeid,$location_id")
     */
    public function getDataForLocationById($woeid, $location_id)
    {
        return Response::json(LocationData::whereRaw('location_id = ?', array($location_id))->orderBy('created_at', 'desc')->take(1)->get());
    }
}

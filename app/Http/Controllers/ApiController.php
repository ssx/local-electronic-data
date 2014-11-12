<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Location;
use App\Models\LocationData;
use App\Models\Overview;
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
     * @Get("/v1/overview/{woeid}", as="woeid")
     */
    public function getOverview($woeid)
    {
        // While we're in development we'll send a notification to say the API has been used
        $objPushyApp = new \Pushy\Client(getenv("PUSHOVER_KEY_APP"));
        $objPushyUser = new \Pushy\User(getenv("PUSHOVER_KEY_USER"));
        $objPushyMessage = (new \Pushy\Message)
            ->setMessage("User Agent: ".$_SERVER["HTTP_USER_AGENT"])
            ->setTitle("API Request: ".$_SERVER["REMOTE_ADDR"])
            ->setUser($objPushyUser);

        // Send notification
        $objPushyApp->sendMessage($objPushyMessage);

        // Create an array to store our response
        $aryReturn = [];

        // Get all the overview records for the given woeid
        $Overviews = Overview::whereRaw('woeid = ?', array("woeid" => $woeid))->orderBy("free_00", "DESC");
        if ($Overviews->count() > 0)
        {
            foreach ($Overviews->get() as $LocationOverview)
            {
                $aryReturn[] = $LocationOverview;
            }
        }

        // Return the response as a JSON array
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

<?php namespace App\Console\Commands;

use App\Models\ParkingDataModel;
use Illuminate\Console\Command;
use Maknz\Slack\Facades\Slack as Slack;

class ParkingUpdateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'data:parking:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update Parking Data from Remote Services.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
    {
        Slack::send("Running parking data update cycle");

        $stuff = file_get_contents('http://southampton.romanse.org.uk/emerge/carparks.asp');
        $needles = array('/\r/s', '/\n/s', '/<!-- display a warning that prediction data is not available -->/si', '/&nbsp;/s', '/\t/s', '/<td class="InfoData"><\/td>/si');
        $reps = array('', '', '', '0', '', '<td class="InfoData">0</td>');
        $stuff = preg_replace($needles, $reps, $stuff);
        $result = preg_match_all('/<tr><!-- Car park name --><td class="InfoData" align="left"><a href=".+?carpark\',\'([A-Za-z0-9]+)[^><]+?>([^><]+)<\/a><\/td><!-- Car park capacity --><td class="InfoData">([^><]+)<\/td><td class="InfoData">([^><]+)<\/td><td class="InfoData">([^><]+?)<\/td><td class="InfoData">([^><]+?)<\/td><td class="InfoData">([^><]+?)<\/td><td class="InfoData">([^><]+)<\/td><td class="InfoData">([^><]+)<\/td><\/tr>/si', $stuff, $matches);

        // Loop through and build an array representing the carpark in a table
        $total = count($matches[0]);
        $x = 0;
        while ($x < $total) {
            // Car Park ID
            $location_id    = $matches[1][$x];
            $name           = $matches[2][$x];
            $capacity       = (int)$matches[3][$x];
            $state          = strtolower($matches[4][$x]);
            $free_00        = (int)$matches[5][$x];
            $free_30        = (int)$matches[7][$x];
            $free_60        = (int)$matches[8][$x];
            $timestamp      = strtotime(str_replace("/", "-", $matches[9][$x]));
            $used           = $capacity - $free_00;

            // Check state of this caching
            if ($state == "closed") {
                $used = 0;
                $free_00 = 0;
                $free_30 = 0;
                $free_60 = 0;
            }

            // Firstly, check to see that we know this car park
            $objName = \DB::select("SELECT name FROM parking_locations WHERE location_id = ? LIMIT 1", array($location_id));

            // Test to see whether we have any data
            if (isset($objName[0]->name))
            {
                Slack::send("Processing known car park: ".$location_id);

                $intCount = ParkingDataModel::where("location_id", "=", $location_id)->where("timestamp", "=", $timestamp)->count();
                if ($intCount == 0)
                {
                    $ParkingData                    = new ParkingDataModel();
                    $ParkingData->location_id       = $location_id;
                    $ParkingData->timestamp         = $timestamp;
                    $ParkingData->collection_date   = date("Y-m-d", $timestamp);
                    $ParkingData->collection_time   = date("H:i:s", $timestamp);
                    $ParkingData->state             = $state;
                    $ParkingData->capacity          = $capacity;
                    $ParkingData->used              = $used;
                    $ParkingData->free_00           = $free_00;
                    $ParkingData->free_30           = $free_30;
                    $ParkingData->free_60           = $free_60;
                    $ParkingData->save();

                    Slack::send("Success: Added new ParkingData: ".$ParkingData->id);
                } else
                {
                    Slack::send("Error: Record already exists");
                }
            } else
            {
                Slack::send("Error: Unknown car park found: ".$location_id);
            }

            // Move on to the next car park
            $x++;
        }

        \Slack::send("End of update cycle.");
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(

		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(

		);
	}

}

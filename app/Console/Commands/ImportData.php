<?php

namespace App\Console\Commands;

use App\Models\Route;
use App\Models\Airport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from txt file';

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
     * @return int
     */
    public function handle()
    {

        \DB::table('airports')->truncate();

        $open = fopen(public_path() . '/airports.txt','r');

        while ( ! feof($open) )
        {
            $getTextLine = fgets($open);
            $explodeLine = explode(",",$getTextLine);

            list(
                $airport_id,
                $airport_name,
                $city,
                $country,
                $iata,
                $icao,
                $latitude,
                $longitude,
                $altitude,
                $timezone,
                $dst,
                $tz_database,
                $type,
                $source
            ) = $explodeLine;

            if( $city )
            {

                $aiport = new Airport();
                $aiport->airport_id = $airport_id;
                $aiport->airport_name = str_replace('"', '', $airport_name);
                $aiport->city = str_replace('"', '', $city);
                $aiport->country = str_replace('"', '', $country);
                $aiport->iata = $iata != "\N" ? str_replace('"', '', $iata) : null;
                $aiport->icao = str_replace('"', '', $icao);
                $aiport->latitude = $latitude;
                $aiport->longitude = $longitude;
                $aiport->altitude = $altitude;
                $aiport->timezone = $timezone;
                $aiport->dst = str_replace('"', '', $dst);
                $aiport->tz_database = $tz_database != "\N" ? str_replace('"', '', $tz_database) : null;
                $aiport->type = str_replace('"', '', $type);
                $aiport->source = str_replace('"', '', $source);
                $aiport->save();
            }
        }

        \DB::table('routes')->truncate();

        $open = fopen(public_path() . '/routes.txt','r');

        while ( ! feof($open) )
        {
            $getTextLine = fgets($open);
            $explodeLine = explode(",",$getTextLine);

            list(
                $airline,
                $airline_id,
                $source_airport,
                $source_airport_id,
                $destination_airport,
                $destination_airport_id,
                $codeshare,
                $stops,
                $equipment,
                $price,
            ) = $explodeLine;

            $route = new Route();

            $route->airline = $airline;
            $route->airline_id = $airline_id;
            $route->source_airport = $source_airport;
            $route->source_airport_id = $source_airport_id;
            $route->destination_airport = $destination_airport;
            $route->destination_airport_id = $destination_airport_id;
            $route->codeshare = $codeshare;
            $route->stops = $stops;
            $route->equipment = $equipment;
            $route->price = $price;
            $route->save();


        }

    }
}

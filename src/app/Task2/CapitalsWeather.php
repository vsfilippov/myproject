<?php

namespace App\Task2;

class CapitalsWeather
{
    private const COUNTRIES_TO_CAPITALS_LIST = [
        "Italy" => "Rome",
        "Luxembourg" => "Luxembourg",
        "Belgium" => "Brussels",
        "Denmark" => "Copenhagen",
        "Finland" => "Helsinki",
        "France" => "Paris",
        "Slovakia" => "Bratislava",
        "Slovenia" => "Ljubljana",
        "Germany" => "Berlin",
        "Greece" => "Athens",
        "Ireland" => "Dublin",
        "Netherlands" => "Amsterdam",
        "Portugal" => "Lisbon",
        "Spain" => "Madrid",
        "Sweden" => "Stockholm",
        "United Kingdom" => "London",
        "Cyprus" => "Nicosia",
        "Lithuania" => "Vilnius",
        "Czech Republic" => "Prague",
        "Estonia" => "Tallin",
        "Hungary" => "Budapest",
        "Latvia" => "Riga",
        "Malta" => "Valetta",
        "Austria" => "Vienna",
        "Poland" => "Warsaw"
    ];

    private const WIND_ROSE_LIST = [
        'N' => 'North',
        'NNE' => 'North-Northeast',
        'NE' => 'North-East',
        'E' => 'East',
        'SE' => 'South-East',
        'SSE' => 'South-Southeast',
        'S' => 'South',
        'SW' => 'South-West',
        'SSW' => 'South-Southwest',
        'W' => 'West',
        'NW' => 'North-West',
        'NNW' => 'North-Northwest',
    ];

    public function show()
    {
        $countriesToCapitals = self::COUNTRIES_TO_CAPITALS_LIST;
        asort($countriesToCapitals);

        $metaWeatherClient = new MetaWeatherApiClient();
        foreach ($countriesToCapitals as $country => $capital) {
            $woeid = $metaWeatherClient->getWhereOnEarthId($capital);
            if (!$woeid) {
                continue;
            }
            $todayData = $metaWeatherClient->getTodayData($woeid);
            if (!$todayData) {
                continue;
            }

            $windSpeed = round($todayData[MetaWeatherApiClient::WIND_SPEED_KEY], 2);
            $windDirection = self::WIND_ROSE_LIST[$todayData[MetaWeatherApiClient::WIND_DIRECTION_COMPASS_KEY]];
            $windDirectionText = $windDirection ? "The direction of the wind is $windDirection." : '';
            echo "The capital of $country is $capital. Today: Wind speed is $windSpeed; $windDirectionText" . PHP_EOL;
        }
    }
}

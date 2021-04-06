<?php

namespace App\Task2;

use App\Utils\AbstractApiClient;

class MetaWeatherApiClient extends AbstractApiClient
{
    private const BASE_URL = 'https://www.metaweather.com/api/location';
    private const WHERE_ON_EARTH_ID_KEY = 'woeid';
    public const WIND_SPEED_KEY = 'wind_speed';
    public const WIND_DIRECTION_COMPASS_KEY = 'wind_direction_compass';
    public const CONSOLIDATED_WEATHER_KEY = 'consolidated_weather';
    public const APPLICABLE_DATE_KEY = 'applicable_date';

    public function getWhereOnEarthId(string $city): ?int
    {
        $output = $this->get(sprintf("%s/search/?query=%s", self::BASE_URL, strtolower($city)));

        return $output ? $output[0][self::WHERE_ON_EARTH_ID_KEY] : null;
    }

    private function getLocation(int $woeid): array
    {
        return $this->get(sprintf("%s/%s/", self::BASE_URL, $woeid));
    }

    public function getTodayData(int $woeid): ?array
    {
        $today = date('Y-m-d');
        $consolidatedWeather = $this->getLocation($woeid)[self::CONSOLIDATED_WEATHER_KEY];
        $result = null;

        foreach ($consolidatedWeather as $weather) {
            if ($today !== $weather[self::APPLICABLE_DATE_KEY]) {
                continue;
            }
            $result = $weather;
        }

        return $result;
    }
}

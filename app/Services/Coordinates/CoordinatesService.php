<?php

namespace App\Services\Coordinates;

class CoordinatesService
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $radius
     * @return array{latitude: double, longitude: double}
     */
    public function getRandomCoordinates(float $latitude, float $longitude, int $radius): array
    {
        $radiusEarth = 6371; // Earth's radius in kilometers

        // Convert latitude and longitude from degrees to radians
        $lat = deg2rad($latitude);
        $lon = deg2rad($longitude);

        // Generate random distance and angle
        $distance = sqrt(mt_rand(0, 1) * $radius * $radius);
        $angle = deg2rad(mt_rand(0, 360));

        // Calculate new latitude and longitude
        $newLat = asin(sin($lat) * cos($distance / $radiusEarth) + cos($lat) * sin($distance / $radiusEarth) * cos($angle));
        $newLon = $lon + atan2(sin($angle) * sin($distance / $radiusEarth) * cos($lat), cos($distance / $radiusEarth) - sin($lat) * sin($newLat));

        // Convert back from radians to degrees
        $newLat = rad2deg($newLat);
        $newLon = rad2deg($newLon);

        return [
            'latitude' => $newLat,
            'longitude' => $newLon
        ];
    }
}

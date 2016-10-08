<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Cache;
use Carbon\Carbon;

class BookingCom
{
    private static function getAuthBasic()
    {
        $auth = [env('APP_BCOM_AUTH_USER'), env('APP_BCOM_AUTH_PASS')];
        return $auth;
    }

    private static function sendRequest($verb, $endpoint, $query)
    {
        $query['rows'] = 1000;

        $auth = static::getAuthBasic();
        $client = new Client(['base_uri' => env('APP_BCOM_ENDPOINT')]);
        $response = $client->request($verb, $endpoint, ['query' => $query, 'auth' => $auth]);
        $parsedResponse = json_decode((string)$response->getBody(), true);

        return $parsedResponse;

    }

    private static function sendGetRequest($endpoint, $params)
    {
        return static::sendRequest('GET', $endpoint, $params);
    }

    private static function sendPostRequest($endpoint, $params)
    {
    }

    public static function getHotels($params)
    {
        $key = (isset($params['city_ids'])) ? $params['city_ids'] : $params['hotel_ids'];

        if (Cache::has('hotels_' . $key)) {
            return Cache::get('hotels_' . $key);
        } else {
            $params['countrycodes'] = 'ph';
            $query['languagecodes'] = 'en';

            $endpoint = 'bookings.getHotels';
            $response = static::sendGetRequest($endpoint, $params);

            $expiresAt = Carbon::now()->addMinutes(10);
            Cache::add('hotels_' . $key, $response, $expiresAt);

            return $response;
        }

    }

    public static function getHotelDescriptionPhotos($params)
    {
        if (Cache::has('hotelDescriptionPhotos_' . $params['hotel_ids'])) {
            return Cache::get('hotelDescriptionPhotos_' . $params['hotel_ids']);
        } else {
            $endpoint = 'bookings.getHotelDescriptionPhotos';
            $response = static::sendGetRequest($endpoint, $params);

            $arrangedResponse = [];

            foreach ($response as $hotel) {
                if (isset($arrangedResponse[$hotel['hotel_id']])) {
                    array_push($arrangedResponse[$hotel['hotel_id']], $hotel);
                } else {
                    $arrangedResponse[$hotel['hotel_id']][] = $hotel;
                }
            }

            $expiresAt = Carbon::now()->addMinutes(10);
            Cache::add('hotelDescriptionPhotos_' . $params['hotel_ids'], $arrangedResponse, $expiresAt);

            return $arrangedResponse;
        }
    }

    public static function getCities($params)
    {
        if (Cache::has('cities')) {
            return Cache::get('cities');
        } else {
            $endpoint = 'bookings.getCities';
            $response = static::sendGetRequest($endpoint, $params);

            Cache::forever('cities', $arrangedResponse, $expiresAt);

            return $response;
        }
    }

    public static function getHotelAvailability($params)
    {
        $endpoint = 'getHotelAvailabilityV2';
        $response = static::sendGetRequest($endpoint, $params);

        $arrangedResponse = [];
        foreach ($response['hotels'] as $hotel) {
            if (isset($arrangedResponse[$hotel['hotel_id']])) {
                array_push($arrangedResponse[$hotel['hotel_id']], $hotel);
            } else {
                $arrangedResponse[$hotel['hotel_id']][] = $hotel;
            }
        }

        return $arrangedResponse;
    }

    public static function getHotelBlockAvailability($params)
    {
        $endpoint = 'bookings.getBlockAvailability';
        $response = static::sendGetRequest($endpoint, $params);

        return $response;
    }
}
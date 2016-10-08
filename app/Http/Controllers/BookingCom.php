<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BookingCom
{
    private static function getAuthBasic()
    {
        $auth = [env('APP_BCOM_AUTH_USER'), env('APP_BCOM_AUTH_PASS')];
        return $auth;
    }

    private static function sendRequest($verb, $endpoint, $query)
    {
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
        $endpoint = 'bookings.getHotels';
        $response = static::sendGetRequest($endpoint, $params);

        return $response;
    }

    public static function getHotelDescriptionPhotos($params)
    {
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

        return $arrangedResponse;
    }

    public static function getCities($params)
    {
        $endpoint = 'bookings.getCities';
        $response = static::sendGetRequest($endpoint, $params);
        
        return $response;
    }
}
<?php
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

        dd($parsedResponse);

    }

    private static function sendGetRequest($endpoint, $params)
    {
        static::sendRequest('GET', $endpoint, $params);
    }

    private static function sendPostRequest($endpoint, $params)
    {
    }

    public static function getCities($params)
    {
        $endpoint = 'bookings.getCities';

        $response = static::sendGetRequest($endpoint, $params);
    }
}
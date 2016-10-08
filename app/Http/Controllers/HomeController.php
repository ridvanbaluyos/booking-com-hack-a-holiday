<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BookingCom;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class HomeController extends Controller
{
    public function getIndex()
    {
        $params['languagecodes'] = 'en';
        $params['countrycodes'] = 'ph';
        $params['city_ids'] = '-2437894';
        $params['countrycodes'] = 'ph';
        $params['languagecodes'] = 'en';
//        $params['rows'] = 10;

        // TODO: cache this
        $hotels = BookingCom::getHotels($params);
        $hotelIds = [];
        foreach ($hotels as $hotel) {
            $hotelIds[] = $hotel['hotel_id'];
        }
        $params['hotel_ids'] = implode(',', $hotelIds);;
        $hotelDescriptionPhotos = BookingCom::getHotelDescriptionPhotos($params);

        $data['hotels'] = $hotels;
        $data['hotelDescriptionPhotos'] = $hotelDescriptionPhotos;

        return view('home.index', ['data' => $data]);
    }
}
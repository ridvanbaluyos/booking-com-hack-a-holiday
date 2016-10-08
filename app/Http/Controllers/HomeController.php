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
        // TODO: cache this
        $hotels = BookingCom::getHotels($params);
        $hotelIds = [];
        foreach ($hotels as $hotel) {
            $hotelIds[] = $hotel['hotel_id'];
        }
        $hotelIds = implode(',', $hotelIds);
        $params['hotel_ids'] = $hotelIds;
        $hotelDescriptionPhotos = BookingCom::getHotelDescriptionPhotos($params);

        $availabilityParams['checkin'] = date('Y-m-d');
        $availabilityParams['checkout'] =  date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"));
        $availabilityParams['room1'] = 'A,A'; // 2 Adults
        $availabilityParams['hotel_ids'] = $hotelIds;

        $hotelAvailability = BookingCom::getHotelAvailability($availabilityParams);

        $data['hotels'] = $hotels;
        $data['hotelAvailability'] = $hotelAvailability;
        $data['hotelDescriptionPhotos'] = $hotelDescriptionPhotos;

        return view('home.index', ['data' => $data]);
    }

    public function getFestivalHotelListings($id)
    {
        $params['city_ids'] = implode(',', config('app.festivals.' . $id . '.city_ids'));

        $hotels = BookingCom::getHotels($params);
        $hotelIds = [];
        foreach ($hotels as $hotel) {
            $hotelIds[] = $hotel['hotel_id'];
        }
        $hotelIds = implode(',', $hotelIds);
        $params['hotel_ids'] = $hotelIds;
        $hotelDescriptionPhotos = BookingCom::getHotelDescriptionPhotos($params);

        $availabilityParams['checkin'] = date('Y-m-d');
        $availabilityParams['checkout'] =  date('Y-m-d',strtotime(date('Y-m-d') . "+1 days"));
        $availabilityParams['room1'] = 'A,A'; // 2 Adults
        $availabilityParams['hotel_ids'] = $hotelIds;

        $hotelAvailability = BookingCom::getHotelAvailability($availabilityParams);

        $data['hotels'] = $hotels;
        $data['hotelAvailability'] = $hotelAvailability;
        $data['hotelDescriptionPhotos'] = $hotelDescriptionPhotos;

        return view('home.index', ['data' => $data]);
    }

    public function getHotelDetails($id)
    {
        $params['arrival_date'] = '2016-11-01';
        $params['departure_date'] = '2016-11-03';
        $params['hotel_ids'] = $id;
        $params['detail_level'] = 1;
        $params['no_html'] = 1;

        $hotelDetails = BookingCom::getHotels($params);
        $hotelBlockAvailability = BookingCom::getHotelBlockAvailability($params);
        $hotelDescriptionPhotos = BookingCom::getHotelDescriptionPhotos($params);

        $data['hotelBlockAvailability'] = $hotelBlockAvailability;
        $data['hotelDetails'] = $hotelDetails;
        $data['hotelDescriptionPhotos'] = $hotelDescriptionPhotos;

        return view('home.hotels', ['data' => $data]);
    }
}
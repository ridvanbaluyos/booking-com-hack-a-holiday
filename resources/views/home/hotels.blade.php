@extends('layouts.main')
@section('title', $data['hotelDetails'][0]['name'])
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-9">

            <div class="thumbnail">

                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($data['hotelDescriptionPhotos'][$data['hotelDetails'][0]['hotel_id']] as $id=>$photos)
                                    <li data-target="#carousel-example-generic" data-slide-to="{{ $id }}" @if ($id == 0) {{ 'class="active"' }} @endif></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($data['hotelDescriptionPhotos'][$data['hotelDetails'][0]['hotel_id']] as $id=>$photos)
                                    <div class="item @if ($id == 0) {{ 'active' }} @endif">
                                        <img class="slide-image" src="{{ $photos['url_original'] }}" alt="">
                                    </div>
                                @endforeach
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="caption-full">
                    <h1><a href="#">{{ $data['hotelDetails'][0]['name'] }}</a></h1>
                    <div class="ratings">
                        <p class="pull-right">3 reviews</p>
                        <p>
                            @foreach (range(1, $data['hotelDetails'][0]['class']) as $x)
                                <span class="glyphicon glyphicon-star"></span>
                            @endforeach
                            {{ $data['hotelDetails'][0]['exact_class'] }} stars
                        </p>
                    </div>
                    <small>{{ $data['hotelDetails'][0]['address'] }}</small>
                    <p>See more snippets like these online store reviews at <a target="_blank" href="http://bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    <p>Want to make these reviews work? Check out
                        <strong><a href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this building a review system tutorial</a>
                        </strong>over at maxoffsky.com!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>

            </div>

            <table class="table table-hover">
                <tr>
                    <th style="width: 350px;">Accommodation Type</th>
                    <th>Max</th>
                    <th>Price per night</th>
                    <th style="width: 10px;">Quantity</th>
                    <th>Reservation</th>
                </tr>
                @foreach ($data['hotelBlockAvailability'][0]['block'] as $blockAvailability)
                    <tr>
                        <td>
                            <strong>
                                <a href="#">{{ $blockAvailability['name'] }}</a>
                            </strong>
                            <p>
                                <small>
                                    {{ $blockAvailability['block_text']['description'] }}<br />
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="{{ implode(', ', $blockAvailability['block_text']['facilities']) }}">
                                        Facilities
                                    </a>
                                </small>
                            </p>
                        </td>

                        <td>
                            @foreach (range(1, $blockAvailability['max_occupancy']) as $x)
                                <span class="glyphicon glyphicon-user"></span>
                            @endforeach
                        </td>
                        <td style="color: #390">
                            <h4>
                                {{ $blockAvailability['incremental_price'][0]['currency'] }}
                                {{ number_format($blockAvailability['incremental_price'][0]['price'], 2, '.', ',') }}
                            </h4>
                        </td>
                        <td>
                            <select class="form-control">
                                <option>0</option>
                                @foreach (range(1, $blockAvailability['max_occupancy']) as $x)
                                    <option>{{ $x }} ({{ $blockAvailability['incremental_price'][0]['currency'] }} {{ number_format($x *  $blockAvailability['incremental_price'][0]['price'], 2, '.', ',') }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a class="btn btn-success" id="reserve_button_{{ $blockAvailability['block_id'] }}">I'll Reserve</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
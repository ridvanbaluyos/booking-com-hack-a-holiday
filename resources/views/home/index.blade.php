@extends('layouts.main')
@section('content')

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Festivals</p>
            <div class="list-group">
                @foreach (config('app.festivals') as $id=>$festival)
                    <a href="/festivals/{{ $id }}" class="list-group-item">{{ $festival['name'] }} {{ date('Y', strtotime($festival['start_date'])) }}</a>
                @endforeach
            </div>

            <p class="lead">Holidays</p>
            <div class="list-group">
                <a href="#" class="list-group-item">Sinulog</a>
                <a href="#" class="list-group-item">Ati-Atihan</a>
                <a href="#" class="list-group-item">Masskara</a>
                <a href="#" class="list-group-item">Pahiyas</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row carousel-holder">
                <div class="col-md-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="http://placehold.it/800x300" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($data['hotels'] as $hotel)
                    @if (isset($data['hotelDescriptionPhotos'][$hotel['hotel_id']][0]['url_original']))
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail" style="height: 366px;">
                                <a href="/hotels/{{  $hotel['hotel_id'] }}">
                                    <img class="crop" src="{{ $data['hotelDescriptionPhotos'][$hotel['hotel_id']][0]['url_original']  }}" alt="" style="overflow: hidden;
    height: 150px;">
                                </a>
                                <div class="caption">
                                    <h4 class="pull-right"></h4>
                                    <h4><a href="/hotels/{{  $hotel['hotel_id'] }}">{{ $hotel['name'] }}</a></h4>
                                    <div class="ratings">
                                        @foreach (range(1,$hotel['class']) as $x)
                                            <span class="glyphicon glyphicon-star"></span>
                                        @endforeach
                                    </div>

                                    <p><small>{{ $hotel['address'] }}</small></p>
                                    <p class="pull-right reviews">{{ $hotel['review_nr'] }} reviews</p>
                                    <p>
                                        Good {{ $hotel['review_score'] }}
                                    </p>
                                </div>

                                @if (isset($data['hotelAvailability'][$hotel['hotel_id']]))
                                    <div class="price">
                                        <h4>
                                            {{ $data['hotelAvailability'][$hotel['hotel_id']][0]['hotel_currency_code'] }}
                                            {{ $data['hotelAvailability'][$hotel['hotel_id']][0]['price'] }}
                                        </h4>
                                    </div>

                                    <div class="choose-room">
                                        <a class="btn btn-primary" href="#">Choose Room</a>
                                    </div>
                                @else
                                    <div class="soldout">
                                        <h4>Sold out</h4>
                                        <small>We ran out of space at this property.</small>
                                    </div>

                                @endif

                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <h4><a href="#">Not what you're looking for?</a>
                    </h4>
                    <p>Try searching at  <a target="_blank" href="http://www.booking.com">booking.com</a> for a wider range of choices!</p>
                    <a class="btn btn-primary" target="_blank" href="http://www.booking.com">View Booking.com</a>
                </div>
            </div>
        </div>
    </div>
@stop
@extends('layouts.main')
@section('title', config('app.events.' . $data['event_id'] . '.name'))
@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
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
                <div class="col-md-9">
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default">Our top pick first</button>
                        <button type="button" class="btn btn-default">Lowest price first</button>
                        <button type="button" class="btn btn-default">Distance from City</button>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Review Score
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">All Reviewers</a></li>
                                <li><a href="#">Solo Travellers</a></li>
                                <li><a href="#">Couples</a></li>
                                <li><a href="#">Families</a></li>
                                <li><a href="#">Group of Friends</a></li>
                                <li><a href="#">Business Travellers</a></li>
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Stars
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Stars [5→1]</a></li>
                                <li><a href="#">Stars [1→5]</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach ($data['hotels'] as $hotel)
                    @if (isset($data['hotelDescriptionPhotos'][$hotel['hotel_id']][0]['url_original']))
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail" style="height: 410px;">
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

                                    <p><small><span class="glyphicon glyphicon-map-marker"></span> <a href="#">{{ $hotel['address'] }}</a></small></p>
                                    <p class="pull-right reviews"><small>{{ $hotel['review_nr'] }} reviews</small></p>
                                    <p><h4>
                                        <span class="label @if ($hotel['review_score'] > 5) label-success @else label-warning @endif">Review Score: {{ $hotel['review_score'] }}</span>
                                    </h4>
                                    </p>
                                </div>

                                @if (isset($data['hotelAvailability'][$hotel['hotel_id']]))
                                    <div class="price">
                                        <h4>
                                            {{ $data['hotelAvailability'][$hotel['hotel_id']][0]['hotel_currency_code'] }}
                                            {{ number_format($data['hotelAvailability'][$hotel['hotel_id']][0]['price'], 2, '.', ',') }}
                                        </h4>
                                    </div>

                                    <div class="choose-room">
                                        <a class="btn btn-primary" href="/hotels/{{  $hotel['hotel_id'] }}">Choose Room</a>
                                    </div>
                                @else
                                    <div class="soldout">
                                        <h4>Sold out</h4>
                                        <small>Sorry, we ran out of space at this property.</small>
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
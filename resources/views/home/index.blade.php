@extends('layouts.main')
@section('title', 'Hack a Holiday Manila - Booking.com')
@section('content')

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Holiday</p>
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
                            <div class="thumbnail">
                                <img src="{{ $data['hotelDescriptionPhotos'][$hotel['hotel_id']][0]['url_original']  }}" alt="">
                                <div class="caption">
                                    <h4 class="pull-right"></h4>
                                    <h4><a href="{{  $hotel['url'] }}">{{ $hotel['name'] }}</a>
                                    </h4>
                                    <p>{{ $hotel['address'] }}</a></p>
                                </div>
                                <div class="ratings">
                                    <p class="pull-right">{{ $hotel['review_nr'] }} reviews</p>
                                    <p>
                                        @foreach (range(1,$hotel['class']) as $x)
                                            <span class="glyphicon glyphicon-star"></span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="col-sm-4 col-lg-4 col-md-4">
                    <h4><a href="#">Like this template?</a>
                    </h4>
                    <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                    <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                </div>
            </div>
        </div>
    </div>
@stop
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
                        <p class="pull-right">
                            <h3><span class="label label-warning">Review Score: {{ $data['hotelDetails'][0]['review_score'] }}</span></h3>
                        </p>
                        <p>
                            @foreach (range(1, $data['hotelDetails'][0]['class']) as $x)
                                <span class="glyphicon glyphicon-star"></span>
                            @endforeach
                            {{ $data['hotelDetails'][0]['exact_class'] }} stars
                        </p>
                    </div>
                    <small>{{ $data['hotelDetails'][0]['address'] }}</small>
                    <br/>
                    <p>
                        Conveniently administrate client-centered technology whereas wireless infrastructures. Dramatically disintermediate innovative results vis-a-vis B2B ideas. Quickly empower principle-centered information whereas installed base paradigms. Credibly strategize enterprise-wide processes.
                    </p>
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
                                    <strong>Policies</strong>
                                    <ul>
                                        @foreach($blockAvailability['block_text']['policies'] as $policy)
                                            {{ $policy['content'] }}
                                        @endforeach
                                    </ul>
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
                            @if ($blockAvailability['breakfast_included'] == 1)
                                <small><span class="glyphicon glyphicon-coffee-cup"></span>Breakfast included </small>
                            @endif
                        </td>
                        <td>
                            <select class="form-control">
                                <option>0</option>
                                @foreach (range(1, $blockAvailability['max_occupancy']) as $x)
                                    <option>{{ $x }} ({{ $blockAvailability['incremental_price'][0]['currency'] }} {{ number_format($x *  $blockAvailability['incremental_price'][0]['price'], 2, '.', ',') }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td><a class="btn btn-primary" id="reserve_button_{{ $blockAvailability['block_id'] }}">I'll Reserve</a></td>
                    </tr>
                @endforeach
            </table>

            <div class="well">
                <p class="lead">Good to know</p>
                <table class="table table-hover">
                    <tr>
                        <th>Check-in</th>
                        <td>{{ $data['hotelDetails'][0]['checkin']['from'] }} to {{ $data['hotelDetails'][0]['checkin']['to'] }} hours</td>
                    </tr>
                    <tr>
                        <th>Check-out</th>
                        <td>{{ $data['hotelDetails'][0]['checkout']['from'] }} to {{ $data['hotelDetails'][0]['checkout']['to'] }} hours</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop
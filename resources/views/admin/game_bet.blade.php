@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card text-left xs-12">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">{{$game_bet->game->game}}</h4>
                </div>
                <div class="col-6">
                    <h4 class="card-title">{{$game_bet->game->league->des}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="card-text">{{$game_bet->game->date}}</p>
                </div>
                <div class="col-6">
                    <p class="card-text">{{$game_bet->game->sport->des}}</p>
                </div>
            </div>
            <div class="row">
                @foreach($game_bet->game->team as $team)
                <div class="col">
                    <a href="/team/{{$team->team->id}}" style="text-decoration:none;" "><button type=" button" class="btn btn-primary">{{$team->team->des}}</button></a>
                </div>

                @endforeach
            </div>
            <div class="row mt-2">
                <div class="col">@if($surebet>0)
                    <button type="button" class="btn btn-success rounded">Surebet: {{$surebet}}</button>
                    @else
                    <button type="button" class="btn btn-danger rounded">Surebet: {{$surebet}}</button>

                    @endif</div>
            </div>
        </div>
    </div>
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Last Odds: {{$market_des->des}}</h4>
            <p class="card-text">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th>Des</th>
                            <th>Min Odd</th>
                            <th>Last Odd</th>
                            <th>Max Odd</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($last_odds as $row)
                        <tr>

                            <td>
                                <p>{{$row[0]}}</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-block rounded"> {{$row[3]}}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-block rounded"> {{$row[1]}}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success  btn-block rounded"> {{$row[2]}}</button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </p>
        </div>
    </div>

    <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Surebets</h4>
            <table class="table table-hover  table-sm table-bordered mt-3" id="myTable2">
                <thead>
                    <tr>
                        <th scope="col">Market</th>
                        <th scope="col">Benefit</th>
                        <th scope="col">Odds</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($surebets as $surebet)
                    <tr>
                        <td><a href="/admin/gamebet/{{$surebet->game_bet_id}}" style="text-decoration:none;">{{$surebet->market->des}}</a></td>
                        <td><a href="/admin/gamebet/{{$surebet->game_bet_id}}" style="text-decoration:none;">{{number_format($surebet->benefit,2)}}%</a></td>
                        <td>
                            @foreach($surebet->odds as $surebet_odd)

                            <button type="button" class="btn btn-info m-2 btn-sm">
                                <h5>{{$surebet_odd->odd->des}} <span class="badge badge-dark">{{$surebet_odd->odd->odd}}</span></h5>
                            </button>
                            @endforeach


                        </td>

                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>




</div>


@endsection
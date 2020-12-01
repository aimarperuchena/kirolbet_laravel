@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card text-left xs-12">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">{{$game->game}}</h4>
                </div>
                <div class="col-6">
                    <h4 class="card-title">{{$game->league}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="card-text">{{$game->date_time}}</p>
                </div>
                <div class="col-6">
                    <p class="card-text">{{$game->sport}}</p>
                </div>
            </div>
            <div class="row">
                @foreach($teams as $team)
                <div class="col">
                    <a href="/team/{{$team->id}}" style="text-decoration:none;" class="text-dark""><button type=" button" class="btn btn-primary">{{$team->des}}</button></a>
                </div>
                @endforeach
            </div>
            <div class="row mt-2">
                <div class="col">@if($surebet>0)
                    <button type="button" class="btn btn-success" disabled>Surebet: {{$surebet}}</button>
                    @else
                    <button type="button" class="btn btn-danger" disabled>Surebet: {{$surebet}}</button>

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
                                <button type="button" class="btn btn-danger btn-block" disabled> {{$row[3]}}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary btn-block" disabled> {{$row[1]}}</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success  btn-block" disabled> {{$row[2]}}</button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </p>
        </div>
    </div>




</div>


@endsection
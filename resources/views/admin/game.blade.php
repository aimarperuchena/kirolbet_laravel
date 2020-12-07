@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="row">
        <div class="col">
            <div class="card text-left xs-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">{{$game->game}}</h4>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title">{{$game->league->des}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text">{{$game->date}} {{$game->time}}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">{{$game->sport->des}}</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($game->team as $team)
                        <div class="col">
                            <a href="/team/{{$team->team->id}}" style="text-decoration:none;" "><button type=" button" class="btn btn-primary">{{$team->team->des}}</button></a>
                        </div>

                        @endforeach
                    </div>
                    <div class="row mt-3">
                        <h3><span class="badge badge-secondary">Surebets: {{$game->surebets->count()}} // {{number_format($game->surebets->avg('benefit'),2)}}%</span></h3>

                    </div>
                    <div class="row mt-3">
                        <div class="accordion" id="accordionExample">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Markets
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="input-group mb-1 justify-content-center">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search" /></span>
                                                    </div>
                                                    <input type="text" id="myInput" class="form-control border" placeholder="Search for markets.." title="Type in a market">
                                                </div>
                                                <table class="table table-hover  table-sm table-bordered mt-3" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Market</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($game->game_bets as $game_bet)
                                                        <tr>
                                                            <td><a href="/admin/gamebet/{{$game_bet->id}}" style="text-decoration:none;">{{$game_bet->market->des}}</a></td>
                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Surebets
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="input-group mb-1 justify-content-center">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search" /></span>
                                                    </div>
                                                    <input type="text" id="myInput2" class="form-control border" placeholder="Search for markets.." title="Type in a market">
                                                </div>
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
                                                            
                                                                <button type="button" class="btn btn-info m-2 btn-sm"><h5>{{$surebet_odd->odd->des}} <span class="badge badge-dark">{{$surebet_odd->odd->odd}}</span></h5></button>
                                                                @endforeach


                                                            </td>

                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                                {{ $surebets->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>


                </div>
            </div>
        </div>

    </div>






</div>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#myInput2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable2 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

@endsection
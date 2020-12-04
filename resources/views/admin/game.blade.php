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
                            <a href="/team/{{$team->id}}" style="text-decoration:none;" "><button type=" button" class="btn btn-primary">{{$team->des}}</button></a>
                        </div>
                        @endforeach
                    </div>
                    <div class="row mt-3">
                        <h3><span class="badge badge-secondary">Surebets: {{$surebets_totals->cont}} // {{$surebets_totals->average}}%</span></h3>
                      
                    </div>

                </div>
            </div>
        </div>

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
                                        @foreach($game_bets as $game_bet)
                                        <tr>
                                            <td><a href="/gamebet/{{$game_bet->id}}" style="text-decoration:none;">{{$game_bet->des}}</a></td>
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


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($surebets_list as $surebet)
                                        <tr>
                                            <td><a href="/gamebet/{{$game_bet->id}}" style="text-decoration:none;">{{$surebet->market_des}}</a></td>
                                            <td><a href="/gamebet/{{$game_bet->id}}" style="text-decoration:none;">{{$surebet->benefit}}%</a></td>

                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
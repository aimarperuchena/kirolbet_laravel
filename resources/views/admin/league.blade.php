@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card text-left">

        <div class="card-body">
            <h4 class="card-title">{{$league->league}} <a href="/admin/leagues/{{$sport->id}}" class="btn btn-light btn-lg active" role="button" aria-pressed="true">{{$league->sport}}</a>
            </h4>

            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class=" card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-light btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Games
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="input-group mb-1 justify-content-center">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="myInput" class="form-control border" placeholder="Search for names.." title="Type in a name">
                                    </div>
                                    <table class="table table-hover  table-sm" id="myTable">
                                        <thead>
                                            <th>Game</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach($games as $game)
                                            <tr>
                                                <td class="row-text"> <a href="/admin/game/{{$game->id}}" style="text-decoration:none;" ">{{$game->game}}</a></td>
                              <td><a href="/admin/game/ {{$game->id}}" style="text-decoration:none;">{{$game->date_time}}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Teams
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="input-group mb-1 justify-content-center">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="teamInput" class="form-control border" placeholder="Search for names.." title="Type in a name">
                                    </div>
                                    <table class="table table-hover  table-sm" id="teamTable">
                                        <thead>
                                            <th>Team</th>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td class="row-text"> <a href="/team/{{$team->id}}" style="text-decoration:none;" ">{{$team->des}}</a></td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div></div>
                <div class=" col">
                                                        <div class="accordion" id="accordionExample2">
                                                            <div class="card">
                                                                <div class="card-header" id="headingThree">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                                            Stats
                                                                        </button>
                                                                    </h2>
                                                                </div>

                                                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample2">
                                                                    <div class="card-body">

                                                                        <div class="card text-left mb-3">
                                                                            <ul class="list-group list-group-flush">
                                                                                <li class="list-group-item">Games: {{$total_games->cont}}</li>
                                                                                <li class="list-group-item">Games Today: {{$games_today}}</li>
                                                                                <li class="list-group-item">Surebets: {{$totals_surebets->cont}}</li>
                                                                                <li class="list-group-item">Avg Surebets: {{$totals_surebets->average}}%</li>
                                                                                <li class="list-group-item">Surebets today: {{$surebets_today->cont}}</li>

                                                                                <li class="list-group-item">Avg Surebets Today Games: {{$surebets_today->average}}%</li>


                                                                            </ul>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card">
                                                                <div class="card-header" id="headingFour">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                                            Top Surebets
                                                                        </button>
                                                                    </h2>
                                                                </div>
                                                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample2">
                                                                    <div class="card-body">
                                                                        <table class="table table-hover  table-sm table-bordered" >
                                                                            <thead>
                                                                                <th>Game</th>
                                                                                <th>Market</th>
                                                                                <th>Benefit</th>


                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($surebets_today_list as $surebet)
                                                                                <tr>
                                                                                    <td>{{$surebet->game}}</td>
                                                                                    <td>{{$surebet->market_des}}</td>
                                                                                    <td>{{$surebet->benefit}}%</td>

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
                </div>
                <script>
                    $(document).ready(function() {
                        $(" #myInput").on("keyup", function() {
                            var value = $(this).val().toLowerCase();
                            $("#myTable tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                    $(document).ready(function() {
                        $("#teamInput").on("keyup", function() {
                            var value = $(this).val().toLowerCase();
                            $("#teamTable tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                </script>
                @endsection
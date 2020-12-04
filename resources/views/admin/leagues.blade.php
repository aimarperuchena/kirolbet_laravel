@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">{{$sport->des}} Leagues</h4>
            <div class="row">
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Stats
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">

                                    <div class="card text-left mb-3">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Leagues: {{$total_leagues}}</li>
                                            <li class="list-group-item">Games: {{$total_games}}</li>
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
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Surebets Today
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table class="table table-hover  table-sm table-bordered" id="myTable">
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

                <div class="col ">
                    <h4 class="card-title">Leagues</h4>

                    <div class="input-group mb-1 justify-content-center">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="myInput" class="form-control border" placeholder="Search for names.." title="Type in a name">
                    </div>
                    <table class="table table-hover  table-sm table-bordered" id="myTable">
                        <thead>
                            <th>League</th>
                        </thead>
                        <tbody>
                            @foreach($leagues as $league)
                            <tr>
                                <td><a href="/admin/league/{{$league->id}}" style="text-decoration:none;">{{$league->des}}</a></td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>
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
        });
    </script>


</div>
@endsection
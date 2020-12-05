@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">{{$team->des}} {{$team->sport->des}} </h4>

            <div class="accordion" id="accordionExample">
                <div class=" card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-light btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseTwo">
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
                                    @foreach($team->game_team as $game_team)

                                    <tr>
                                    <td class="row-text"> <a href="/game/{{$game_team->game->id}}" style="text-decoration:none;" ">{{$game_team->game->game}}</a></td>
                                    <td class="row-text"> <a href="/game/{{$game_team->game->id}}" style="text-decoration:none;" ">{{$game_team->game->date}}</a></td>
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
                                Leagues
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table table-hover  table-sm" id="myTable">
                                <thead>
                                    <th>League</th>
                                </thead>
                                <tbody>
                                    @foreach($leagues as $league)
                                    <tr>
                                        <td class="row-text"> <a href="/league/{{$league->id}}" style="text-decoration:none;" ">{{$league->des}}</a></td>
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
        $(" #myInput").on("keyup", function() { var value=$(this).val().toLowerCase(); $("#myTable tr").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value)> -1)
                                                });
                                                });
                                                });
                                                </script>
                                                @endsection
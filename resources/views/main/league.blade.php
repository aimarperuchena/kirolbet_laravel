@extends('layouts.main')
@section('content')
<div class="container">
    <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">{{$league->league}} <a href="/leagues/{{$sport->id}}" class="btn btn-light btn-lg active" role="button" aria-pressed="true">{{$league->sport}}</a>
            </h4>
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
                                        <td class="row-text"> <a href="/game/{{$game->id}}" style="text-decoration:none;" class="text-dark"">{{$game->game}}</a></td> 
                              <td><a href="/game/ {{$game->id}}" style="text-decoration:none;" class="text-dark">{{$game->date_time}}</a></td>
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
                                        <td class="row-text"> <a href="/team/{{$team->id}}" style="text-decoration:none;" class="text-dark"">{{$team->des}}</a></td>
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
<script>
   $(document).ready(function() {
       $(" #myInput").on("keyup", function() { var value=$(this).val().toLowerCase(); $("#myTable tr").filter(function() { $(this).toggle($(this).text().toLowerCase().indexOf(value)> -1)
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
@extends('layouts.main')

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
                            <p class="card-text">{{$game->date}}{{$game->time}}</p>
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

                </div>
            </div>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col">
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
                        <td><a href="/gamebet/{{$game_bet->id}}" style="text-decoration:none;">{{$game_bet->market->des}}</a></td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
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

@endsection
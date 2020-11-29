@extends('layouts.app')

@section('content')
<div class="container">
    



    <table class="table table-hover  table-sm">
        <thead>
            <tr>
                <th scope="col">Sport</th>
                <th scope="col">Leagues</th>
                <th scope="col">Games</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sports as $sport)
            <tr>
                <td>{{$sport->des}}</td>
                @foreach($league_totals as $league_total)
                @if($league_total->sport_id==$sport->id)
                <td>{{$league_total->tot}}</td>
                @endif
                @endforeach

                @foreach($game_totals as $game_total)
                @if($game_total->sport_id==$sport->id)
                <td>{{$game_total->tot}}</td>
                @endif
                @endforeach
            </tr>

            @endforeach

        </tbody>
    </table>
    {{ $sports->links() }}


</div>
@endsection
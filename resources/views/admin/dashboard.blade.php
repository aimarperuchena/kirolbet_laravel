@extends('layouts.admin')

@section('content')
<div class="container">


    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Dashboard</h4>
            <p class="card-text">
                <div class="row">
                    <div class="col">
                        <div class="card text-left" style="width: 18rem;">
                            <h5 class="card-title p-2">Totals</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Odds: {{$odds_count}}</li>
                                <li class="list-group-item">Games: {{$games_count}}</li>
                                <li class="list-group-item">Sports: {{$sports_count}}</li>
                                <li class="list-group-item">Leagues: {{$leagues_count}}</li>
                                <li class="list-group-item">Odds Inserted Today: {{$odds_today}}</li>


                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <table class="table table-bordered table-sm ">
                            <thead>
                                <th>Sport</th>

                            </thead>
                            <tbody>
                                @foreach($sports as $sport)
                                <tr>
                                    <td><a href="/admin/leagues/{{$sport->id}}" style="text-decoration:none;">{{$sport->des}}</a></td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $sports->links() }}
                    </div>
                </div>


            </p>
        </div>
    </div>



</div>
@endsection
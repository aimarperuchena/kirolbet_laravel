@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Sports</h4>
            <table class="table table-hover  table-sm table-border">
                <thead>
                    <th>Sport</th>

                </thead>
                <tbody>
                    @foreach($sports as $sport)
                    <tr >
                        <td><a href="/leagues/{{$sport->id}}" style="text-decoration:none;" class="text-dark">{{$sport->des}}</a></td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            {{ $sports->links() }}

        </div>
    </div>



</div>
@endsection
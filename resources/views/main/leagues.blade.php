@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Leagues</h1>


    <table class="table table-hover  table-sm">

        <tbody>
            @foreach($leagues as $league)
            <tr>
                <td><a href="/league/{{$league->id}}">{{$league->des}}</a></td>

            </tr>

            @endforeach

        </tbody>
    </table>
    {{ $leagues->links() }}



</div>
@endsection
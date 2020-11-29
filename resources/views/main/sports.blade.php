@extends('layouts.app')

@section('content')
<div class="container">



<h3>Sports</h3>
    <table class="table table-hover  table-sm">
        
        <tbody>
            @foreach($sports as $sport)
            <tr>
                <td><a href="/leagues/{{$sport->id}}">{{$sport->des}}</td>
            </tr>

            @endforeach

        </tbody>
    </table>
    {{ $sports->links() }}


</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Games</h1>

    <div class="input-group mb-5 justify-content-center">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" id="myInput" onkeyup="myFunction()" class="form-control border" placeholder="Search for names.." title="Type in a name">
    </div>
    <table class="table table-hover  table-sm" id="myTable">
        <thead>
            <th>Game</th>
            <th>Date</th>
        </thead>
        <tbody>
            @foreach($games as $game)
            <tr>
                <td class="row-text">{{$game->game}}</td>
                <td>{{$game->date_time}}</td>
            </tr>

            @endforeach

        </tbody>
    </table>
   



</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@endsection
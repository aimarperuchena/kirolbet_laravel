@extends('layouts.main')

@section('content')
<div class="container">
    <div class="card text-left">
        <img class="card-img-top" src="holder.js/100px180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Leagues</h4>
            <div class="input-group mb-1 justify-content-center">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="myInput" class="form-control border" placeholder="Search for names.." title="Type in a name">
            </div>
            <table class="table table-hover  table-sm" id="myTable">
                <thead>
                    <th>League</th>
                </thead>
                <tbody>
                    @foreach($leagues as $league)
                    <tr>
                        <td><a href="/league/{{$league->id}}" style="text-decoration:none;" class="text-dark">{{$league->des}}</a></td>

                    </tr>

                    @endforeach

                </tbody>
            </table>
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

@extends('layouts.app2')

@section('content')



        <form method="post" action="/search">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="datepicker">выбрать по дате создания с:</label>
                <input type="text" class="datepicker"  name="datepicker" data-provide="datepicker0" >
                по:
                <input type="text" class="datepicker"  name="datepicker2" data-provide="datepicker" >


            </div>



            <button type="submit" class="btn btn-primary">искать</button>
        </form>

            <script >
            $('.datepicker').datepicker({
                 format: 'yyyy/mm/dd',
                 // startDate: '-3d'
            });
            $('.datepicker2').datepicker({
                 format: 'yyyy/mm/dd',
                 // startDate: '-3d'
            });
            </script>



@endsection
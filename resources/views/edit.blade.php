@extends('layouts.app2')

@section('content')



    <style>
        .uper {
            margin-top: 40px;
            margin-left;: 40px;
            margin-right: 40px;
        }
    </style>

    <div class="form_">

        <div class="card-body">


            @if (@$message)
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ @$message }}</li>
                    </ul>
                </div>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif



                @if (@$action=='new')
                    <form method="post" action="/nadd">
                @else
                    <form method="post" action="/nupdate/{{@$rec->id}}">
                @endif



                {!! csrf_field() !!}


                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value={{ @$rec->name }}>
                </div>

                <div class="form-group">
                    <label for="anons">anons :</label>
                    <input type="text" class="form-control" name="anons" value={{ @$rec->anons }}>
                </div>

                <div class="form-group">
                    <label for="content">content:</label>

                    <textarea name="content" class="form-control"  cols="50" rows="10">{{ @$rec->content }}</textarea>


                </div>


                @if (@$action=='new')
                    <button type="submit" class="btn btn-primary">new!</button>
                @else
                <button type="submit" class="btn btn-primary">Update</button>
                @endif
            </form>
        </div>
    </div>
{{--


    <pre>
        {{ print_r ($rec)}}
    </pre>

--}}



@endsection
@extends('layouts.app2')

@section('content')

    @if (@$message)
        <div class="alert alert-danger">
            <ul>
                    <li>{{ @$message }}</li>
            </ul>
        </div>
    @endif


    <div class="panel-body table-responsive">
        <table class="table table-bordered table-striped {{ count($news) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
            <tr>
                <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                <th>id</th>
                <th>Название</th>
                <th>Анонс (краткое содержание)</th>
                <th>Контент (сама новость)</th>
                <th>создана</th>
                <th>последнее изменение</th>
                <th>действия</th>

            </tr>
            </thead>

            <tbody>
            @if (count($news) > 0)
                @foreach ($news as $n)
                    <tr data-entry-id="{{ $n->id }}">

                        <td> </td>
                        <td>{{ $n->id }}</td>
                        <td>{{ $n->name }}</td>
                        <td>{{ $n->anons }}</td>
                        <td>{{ $n->content }}</td>
                        <td>{{ $n->created_at }}</td>
                        <td>{{ $n->updated_at }}</td>
                        <td>
                            @if(!Auth::guest())
                            <a href="/ndel/{{$n->id}}">Удалить</a>
                            <a href="/nedit/{{$n->id}}">Редактировать</a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">Таблица пустая (ничего не найдено) </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>



@endsection
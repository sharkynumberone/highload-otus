@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h2>Список друзей</h2><br>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Фамилия</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($friends as $friend)
                    <tr>
                        <th scope="row">{{$friend['id']}}</th>
                        <td>{{$friend['first_name']}}</td>
                        <td>{{$friend['last_name']}}</td>
                        <td>
                            @if (!empty($friend['friend']))
                                <a href="{{route('remove_from_friends_list', $friend['id'])}}">Удалить из друзей</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

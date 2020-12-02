@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h2>Список пользователей</h2><br>
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
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user['id']}}</th>
                        <td>{{$user['first_name']}}</td>
                        <td>{{$user['last_name']}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

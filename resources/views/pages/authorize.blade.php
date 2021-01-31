@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h2>Форма авторизации</h2><br>
                <form action="" method="post">
                    @csrf
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email" value="{{ old('email') }}" required><br>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required><br>
                    <button class="btn btn-success" type="submit">Авторизоваться</button>
                </form>
                <br>
                <p>Если вы еще не зарегистрированы, тогда нажмите <a href="/register">здесь</a>.</p>
                <p>Вернуться на <a href="/">главную</a>.</p>
            </div>
        </div>
        @if($errors->any())
            <br/>
            {{ implode('', $errors->all(':message')) }}
        @endif
    </div>
@endsection

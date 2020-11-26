@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <!-- Форма регистрации -->
                <h2>Форма регистрации</h2><br>
                <form action="" method="post">
                    @csrf
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email" value="{{ old('email') }}" required><br>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Введите имя" value="{{ old('first_name') }}" required><br>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Введите фамилию" value="{{ old('last_name') }}" required><br>
                    <input type="text" class="form-control" name="age" id="age" placeholder="Возраст" value="{{ old('age') }}"><br>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required><br>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Повторите пароль" required><br>
                    <select class="form-control" name="gender" value="{{ old('gender') }}">
                        <option value="">Пол</option>
                        <option value="F">Женский</option>
                        <option value="M">Мужской</option>
                    </select><br>
                    <textarea class="form-control" name="interests" placeholder="Интересы" value="{{ old('interests') }}"></textarea><br>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Город" value="{{ old('city') }}"><br>
                    <button class="btn btn-success" type="submit">Зарегистрировать</button>
                </form>
                <br>
                <p>Если вы зарегистрированы, тогда нажмите <a href="/authorize">здесь</a>.</p>
                <p>Вернуться на <a href="/">главную</a>.</p>
            </div>
        </div>
        @if($errors->any())
            <br/>
            {{ implode('', $errors->all(':message')) }}
        @endif
    </div>
@endsection

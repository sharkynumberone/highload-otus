@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <!-- Форма регистрации -->
                <h2>Профиль</h2><br>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user['email'] }}" disabled><br>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Имя" value="{{ $user['first_name'] }}" disabled><br>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Введите фамилию" value="{{ $user['last_name'] }}" disabled><br>
                    <input type="text" class="form-control" name="age" id="age" placeholder="Возраст" value="{{ $user['age'] }}" disabled><br>
                    <select class="form-control" name="gender" disabled>
                        <option value="">Пол</option>
                        <option @if ($user['gender'] === 'F') selected="selected" @endif value="F">Женский</option>
                        <option @if ($user['gender'] === 'M') selected="selected" @endif value="M">Мужской</option>
                    </select><br>
                    <textarea disabled class="form-control" name="interests" placeholder="Интересы" value="{{ $user['interests'] }}"></textarea><br>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Город" value="{{ $user['city'] }}" disabled><br>
            </div>
        </div>
    </div>
@endsection

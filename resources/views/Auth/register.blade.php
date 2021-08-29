@extends('layouts.app')

@section('content')
<form method="POST" enctype="multipart/form-data" action="{{ route('register')}}">
  @csrf
  <h1 class="h3 mb-3 fw-normal">新規登録</h1>

  <div class="register-name">
    <label for="inputPassword" class="visually-hidden">名前</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="名前">
    @if($errors->has('name'))<p class="error">{{$errors->first('name')}}</p>@endif
  </div>

  <div class="register-email">
    <label for="inputEmail" class="visually-hidden">メールアドレス</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス">
    @if($errors->has('email'))<p class="error">{{$errors->first('email')}}</p>@endif
  </div>

  <div class="register-password">
    <label for="inputPassword" class="visually-hidden">パスワード</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード">
    @if($errors->has('password'))<p class="error">{{$errors->first('password')}}</p>@endif
  </div>

  <div class="register-passwordconf">
    <label for="inputPassword" class="visually-hidden">パスワード（確認用）</label>
    <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="パスワード(確認用)">
    @if($errors->has('password-confirm'))<p class="error">{{$errors->first('password-confirm')}}</p>@endif
  </div>

  <label for="inputPassword" class="visually-hidden">プロフィール画像選択</label>
  <input type="file" id="img" name="img" class="form-control" accept=".png,.jpg,.jpeg,image/p
  ng,image/jpg">

 <label for="inputPassword" class="visually-hidden">性別</label>
  <select type="text" class="form-control" name="gender">
    @foreach(config('gender') as $key => $score)
    <option value="{{ $score }}">{{ $score }}</option>
    @endforeach
  </select>

  <label for="inputPassword" class="visually-hidden">年齢</label>
  <select type="text" class="form-control" name="age">
    @foreach(config('age') as $key => $score)
    <option value="{{ $score }}">{{ $score }}</option>
    @endforeach
  </select>

  <label for="inputPassword" class="visually-hidden">紹介文</label>
  <input type="text" id="bio" name="bio" class="form-control">


  <button class="w-100 btn btn-lg btn-primary" type="submit">登録

  </button>
</form>
@endsection
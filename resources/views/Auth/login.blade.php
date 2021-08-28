@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login')}}">
  @csrf
  <h1 class="h3 mb-3 fw-normal">ログインフォーム</h1>
  <label for="inputEmail" class="visually-hidden">メールアドレス</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="メールアドレス">
  <label for="inputPassword" class="visually-hidden">パスワード</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード">
  <button class="w-100 btn btn-lg btn-primary" type="submit">ログイン</button>
</form>
@endsection
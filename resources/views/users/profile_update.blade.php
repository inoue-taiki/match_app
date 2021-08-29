@extends('layouts.app')

@section('content')
<div class="profile_update">
  <tr>
    <!--既存の画像-->
    <td><img src="{{ $user->image_path }}"></td>
    <!--画像更新-->
    <td><input type="file" id="file" name="image_path" class="form-control"></td>
    <td><p>ユーザー名：<input type="text" name="name" value='{{ $user->name }}'></p></td>
    <td><p>性別:{{ $user->gender }}</p></td>
    <td><p>年齢:{{ $user->age }}</p></td>
    <td><p>メールアドレス:<input type="text" name="email" value='{{ $user->email}}'></td>
    <td><p>パスワード</p><input type="text" name="password" value='{{ $user->password}}'></td>
    <td><p>新しいパスワード</p><input type="text" name="newpassword" value=''></td>
    <td><p>紹介文：<input type="text" name="bio" value='{{ $user->bio }}'></p></td>
  </tr>

  <button><a href="{{route('user.profile_update')}}">プロフィール編集</a></button>
</div>
@endsection
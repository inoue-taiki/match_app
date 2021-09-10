@extends('layouts.app')

@section('content')
<div class="match_people">
    <tr>
        <td><a href="{{ route('follow.match') }}">マッチング中</a>:
        {{count($match_lists)}}人</td>
        <td><a href="{{ route('follow.follow') }}">リクエスト中</a>:{{count($request_lists)}}人</td>
        <td><a href="{{ route('follow.follower') }}">リクエスト受け</a>:{{count($requested_lists)}}人</td>
    </tr>
</div>

<div class="profile_table">
  <tr>
    <td><img src="{{ $user->image_path }}"></td>
    <td><p>ユーザー名：{{ $user->name }}</p></td>
    <td><p>性別:{{ $user->gender }}</p></td>
    <td><p>年齢:{{ $user->age }}</p></td>
    <td><p>メールアドレス:{{ $user->email}}</td>
    <td><p>紹介文：{{ $user->bio }}</p></td>
  </tr>

  <button><a href="{{route('user.profile_update')}}">プロフィール編集</a></button>
</div>
@endsection
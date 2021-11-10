@extends('layouts.app')

@section('content')
<div class="table">
  <a href="{{route('user.profile')}}">プロフィール</a>
  <a href="{{route('user.post')}}">投稿画面</a>
  <a href="{{route('user.search')}}">ユーザー追加</a>
  <a href="{{route('user.keep')}}">お気に入り</a>
  <a href="{{route('user.schedule')}}">スケジュール</a>
  <a href="{{route('follow.practice')}}">練習用</a>
</div>
@endsection
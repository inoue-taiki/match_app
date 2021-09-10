@extends('layouts.app')

@section('content')
<div class="table">
  <a href="{{route('user.profile')}}">プロフィール</a>
  <a href="{{route('user.post')}}">投稿画面</a>
  <a href="{{route('user.search')}}">ユーザー追加</a>
  <a href="{{route('user.keep')}}">お気に入り</a>
</div>
@endsection
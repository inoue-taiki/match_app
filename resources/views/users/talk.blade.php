@extends('layouts.app')

@section('content')
<!-- トークユーザーをテーブル表示 -->
<div class="talk_table">
  <tr>
    <td>ユーザー画像</td>
    <td>ユーザー名</td>
    <td><a href="{{ route('talk.detail')}}">トーク</a></td>
  </tr>
</div>
@endsection
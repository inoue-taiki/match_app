@extends('layouts.app')

@section('content')

<div class="main">
  <h2>リクエスト中</h2>

  <div class="follow_table">
    @foreach( $request_lists as $request_list )
    <tr>
      <td><a href="{{ route('user.other') }}">ユーザー画像</a></td>
      <td>{{ $request_list->name }}</td>
      <td>
        <form method="POST" action="{{ route('user.unrequest', $request_list->id)}}">
          @csrf
          <input type="submit" value="リクエスト取下げ" onclick="return confirm('リクエストを取下げますか？')">
        </form>
      </td>
    </tr>
    @endforeach
  </div>

  <p><a href="{{ route('user.profile')}}">プロフィール画面へ戻る</a></p>








</div>

@endsection
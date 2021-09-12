@extends('layouts.app')

@section('content')

<div class="main">
  <h2>リクエスト受け中</h2>

  <div class="follower_table">
    @foreach($requested_lists as $requested_list)
    <tr>
      <td><a href="{{ route('user.other') }}">ユーザー画像</a></td>
      <td>{{ $requested_list->name }}</td>
      <td><button><a href="">トークする</a></button></td>
      <td>
        <form method="POST" action="{{ route('user.add', $requested_list->id)}}">
            @csrf
            <input type="submit" value="リクエストを受ける">
        </form>
      </td>
      <td>
        <form method="POST" action="{{ route('user.decline', $requested_list->id)}}">
          @csrf
          <input type="submit" value="リクエスト拒否" onclick="return confirm('拒否してもよろしいでしょうか？')">
        </form>
      </td>
    </tr>
    @endforeach
  </div>

  <p><a href="{{ route('user.profile')}}">プロフィール画面へ戻る</a></p>








</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="main">
  <h2>マッチング中</h2>

  <div class="match_table">
    @foreach( $match_lists as $match_list )
    <tr>
      <td><a href="{{ route('user.other') }}">ユーザー画像</a></td>
      <td>{{ $match_list->name }}</td>
      <td>{{ $match_list->age }}</td>
      <td>{{ $match_list->bio }}</td>
      <td><button><a href="">トークする</a></button></td>
      <td>
        <form method="POST" action="{{ route('user.unfollow', $match_list->id)}}">
          @csrf
          <input type="submit" value="マッチング解除" onclick="return confirm('削除してもよろしいでしょうか？')">
        </form>
      </td>
    </tr>
    @endforeach

    
  </div>
  
  <p><a href="{{ route('user.profile')}}">プロフィール画面へ戻る</a></p>


</div>

@endsection
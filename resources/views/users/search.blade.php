@extends('layouts.app')

@section('content')

<!-- 検索ボックス -->
<div id="search_box">
  <form action="search" class="searchform">
    <input type="text" name="userwords" id="userwords" placeholder="キーワード検索" required>
    <div class="form-example">
      <input type="submit" value="検索">
    </div>
  </form>
</div>

<!-- 検索結果(条件分岐) -->
@foreach($users as $user)
@if(isset($user))
<div class="search_table">
  <tr>
    <td>{{ $user->image_path }}</td>
    <td><a href="{{ route('user.other') }}">{{ $user->name}}</a></td>
    <td><a href="{{ route('user.keep') }}">お気に入り</a></td>

    <!-- 条件分岐で相手の状態を -->
    <td><button>マッチング中</button></td>
    <td><button>リクエスト中</button></td>
    <td><button>リクエスト受け</button></td>
  </tr>
</div>

@else
<p>検索結果はありません</p>
@endif
@endforeach


@endsection
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
    <td><img src="{{ $user->image_path }}"></td>
    <td><a href="{{ route('user.other',['id' => $user->id]) }}">{{ $user->name}}</a></td>
    <td><a href="{{ route('keep.add', ['id' => $user->id]) }}">♡</a></td>

    @if(in_array($user->id,(array)$match_lists))
    <td><button>マッチング中</button></td>
    @elseif(in_array($user->id,(array)$request_lists))
    <td><button>リクエスト中</button></td>
    @elseif(in_array($user->id,(array)$requested_lists))
    <td><button>リクエスト受け</button></td>
    @else
    <td><td><button>リクエストする</button></td></td>
    @endif
  </tr>
</div>
@else
<p>検索結果はありません</p>
@endif
@endforeach


@endsection


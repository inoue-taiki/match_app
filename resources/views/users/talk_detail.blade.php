@extends('layouts.app')

@section('content')
<!-- トーク内容 -->
<div class="talk_contents">

</div>


<!-- 送信フォーム -->
<div class="form-table">
  <form method="GET" action="{{ route('talk.detail')}}">
    @csrf
    <input type="text" name="newPost">
    <button type="submit">送信</button>
  </form>
</div>

<button><a href="{{ route('user.talk')}}">戻る</a></button>
@endsection
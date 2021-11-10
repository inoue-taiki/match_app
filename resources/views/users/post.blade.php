@extends('layouts.app')

@section('content')
<!-- トーク内容 -->

<div class="post_contents">
  <p>投稿一覧</p>
  @foreach($users as $user)
  <tr>
    <td><p>{{ $user_name }}</p></td>
    <td><p>{{ $user->created_at }}</p></td>
    <td><p>{{ $user->post }}</p></td>
    <td><img src="{{asset('/images/'.$user->image_path)}}"></td>
  </tr>
  @endforeach

</div>

<!-- 送信フォーム -->
<div class="form-table">
  <form method="post" action="{{ route('user.post')}}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="newPost">
    <input type="file" name="image_path">
    <br>
    <button type="submit">送信</button>
  </form>
</div>

@endsection
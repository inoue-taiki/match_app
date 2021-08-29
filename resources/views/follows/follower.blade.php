@extends('layouts.app')

@section('content')

<div class="main">
  <h2>リクエスト受け中</h2>

  <div class="follower_table">
    <tr>
      <td>ユーザー画像</td><!-- 画像にリンク→相手ユーザープロフィールに飛ぶ -->
      <td>ユーザー名</td>
      <td>年齢</td>
      <td><button><a href="">トークする</a></button></td><!-- ID引き継ぎトーク画面へ -->
      <td><button><a href="">リクエストを受ける</a></button></td><!-- 追加機能 -->
      <td><button><a href="#">拒否</a></button></td><!-- delete機能 -->







    </tr>
  </div>








</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="keep_table">
  
  <tr>
    <td>ユーザー画像</td>
    <td><a href="{{ route('user.other') }}"></a></td>

    <!-- 条件分岐で相手の状態を -->
    <td><button>リクエストする</button></td>
    <td><button>マッチング中</button></td>
    <td><button>リクエスト中</button></td>
    <td><button>リクエスト受け</button></td>
    <td>削除する</a></td>
  </tr>
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="keep_table">
  @foreach($keeps as $keep)
 
  <tr>
    <td>ユーザー画像</td>
    <td><a href="{{ route('user.other',['id' => $keep->id]) }}">{{ $keep->name }}</a></td>

    @if(in_array($keep->id ,(array)$match_lists))
    <td><button>マッチング中</button></td>
    @elseif(in_array($keep->id,(array)$request_lists))
    <td><button>リクエスト中</button></td>
    @elseif(in_array($keep->id,(array)$requested_lists))
    <td><button>リクエスト受け</button></td>
    @else
    <td><td><button>リクエストする</button></td></td>
    @endif

    <td>
        <form method="POST" action="{{ route('keep.delete', $keep->other_id)}}">
          @csrf
          <input type="submit" value="削除する" onclick="return confirm('削除してもよろしいでしょうか？')">
        </form>
    </td>
  </tr>
  @endforeach
</div>

@endsection
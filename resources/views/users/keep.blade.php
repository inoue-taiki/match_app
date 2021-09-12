@extends('layouts.app')

@section('content')

<div class="keep_table">
  @foreach($keeps as $keep)
  <tr>
    <td>ユーザー画像</td>
    <td><a href="{{ route('user.other') }}">{{ $keep->other_id }}</a></td>

    
    @if(in_array($keep->id ,(array)$match_lists))
    <td><button>マッチング中</button></td>
    @elseif(in_array($keep->id,(array)$request_lists))
    <td><button>リクエスト中</button></td>
    @elseif(in_array($keep->id,(array)$requested_lists))
    <td><button>リクエスト受け</button></td>
    @else
    <td><td><button>リクエストする</button></td></td>
    @endif
    

    <td>削除する</td>
  </tr>
  @endforeach
</div>

@endsection
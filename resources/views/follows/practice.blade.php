@extends('layouts.app')

@section('content')

@foreach($user_lists as $user_list )
<div class="list">
  <tr>
    <td>{{$user_list->name}}</td>

    @if(in_array($user_list->id,$following_user))
    <td>フォローを外す</td>

    @else
    <td>
      <form method="POST" action="{{ route('follow.add', $user_list->id)}}">
        @csrf
        <input type="submit" value="フォローする">
      </form>
    </td>
    @endif
    
  </tr>
</div>
@endforeach
@endsection
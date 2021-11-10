@extends('layouts.app')

@section('content')

<div class="calendar-container">
    
    
    <button><a class="js-modal-open" href="">+</a></button>

    @foreach($lists as $list)
    <div class="event-lists">
        <tr>
            <td>{{ $list->date }}</td>
            <td>{{ $list->event }}</td>
            <td>{{ $list->memo }}</td>
        </tr>
        <button><a class="edit-modal-open" href="#">編集</a></button>
    </div>
    @endforeach

    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
        <a class="js-modal-close" href="">×</a>
        
        <form method="post" action="{{ route('user.schedule')}}">
            @csrf
            <input type="datetime-local" name="newDate">

            <p>イベント名：<input type="text" name="newEvent"></p>
        
            <p>場所：</p>

            <p>メモ：<input type="text" name="newMemo"></p>

            <button type="submit">追加</button>

        </form> 

        </div>
    </div>

    <div class="modal edit-modal">
        <div class="modal__bg edit-modal-close"></div>
        <div class="modal__content">
        <a class="edit-modal-close" href="">×</a>

        <form method="post" action="{{ route('user.schedule')}}">
            @csrf
            <input type="text" name="edit" value="{{$list->memo}}">
            <input type='hidden' name='update' value="">

            <button type="submit">更新</button>

        </form> 

        </div>
    </div>
</div>


<script type="text/javascript">
$(function(){
    $('.js-modal-open').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });
});

$(function(){
    $('.edit-modal-open').on('click',function(){
        $('.edit-modal').fadeIn();
        return false;
    });
    $('.edit-modal-close').on('click',function(){
        $('.edit-modal').fadeOut();
        return false;
    });
});

</script>


<script src="{{ asset('/js/calender.js') }}"></script>













@endsection
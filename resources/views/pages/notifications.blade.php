@extends('layouts.master')

@section('title', 'Notification')

@section('content')
    
    <div class="notifications col-md-offset-2 col-md-8">
        @foreach($notifications as $notification)
    
            <div class="notification-row">
             
                @if($notification->type == 'questions')

                        @if($notification->Question->anonymous == 0)

                            <b><a href="{{ URL::to('/')  . '/' . $notification->User->username }}">{{ $notification->User->fullname }}</a></b> ask you: <a href="{{ URL::to('/') . '/account/question/' . $notification->Question->id }}">"{{ $notification->Question->content }}"</a>
                            at
                            <br>
                            <span>{{ $notification->created_at }}</span>

                        @elseif($notification->Question->anonymous == 1)
                            you have a new question:  <a href="{{ URL::to('/') . '/account/question/' . $notification->Question->id }}">"{{ $notification->Question->content }}"</a>at
                            {{ $notification->created_at }}
                        @endif 

                @elseif($notification->type == 'Answers') 

                        <b><a href="{{ URL::to('/')  . '/' . $notification->User->username }}">{{ $notification->User->fullname }} </a></b> answered your question <a href="{{ $notification->Question->id }}">"{{ $notification->Question->content }}"
                        </a>
                        at
                            {{ $notification->created_at }}

                @elseif($notification->type == 'likes') 

                        <b><a href="{{ URL::to('/')  . '/' . $notification->User->username }}">{{ $notification->User->fullname }} </a></b> likes your questions <a href="{{ $notification->Question->id }}">"{{ $notification->Question->content }}"
                        </a>
                        at 
                            {{ $notification->created_at }}

                @endif

            </div>
        @endforeach
    </div>

@stop
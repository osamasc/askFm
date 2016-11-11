@extends('layouts.master')

@section('title', $user->fullname . ' (@' . $user->username . ')')

@section('content')
    <div class="row">
        <div class="col-md-11 cover">
            <div class="user-info">
                <b>{{ $user->fullname }}</b> <br> {{ '@' . $user->username   }}            
            </div>
            <div>
                    @if( $user->id != $currentAuth->id && $followed != 1 )
                        <form action="{{ URL::to('/') . '/relations'}}" method="POST"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="followed_id" value="{{ $user->id }}">
                            <input type="submit" value="Follow" class="btn btn-sm btn-success">
                        </form>
                    @elseif ($user->id != $currentAuth->id && $followed == 1)
                        <form action="{{ URL::to('/') . '/relations/remove'}}" method="POST"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="followed_id" value="{{ $user->id }}">
                            <input type="submit" value="Unfollow" class="btn btn-sm btn-success">
                        </form>
                    @endif  

            </div>
        </div>    
    </div>
    
    <div class="row">
         <div class="info col-md-11">
             <div><b>Answers {{ $answerCount }}</b></div>
             <div>Likes</div>
             <div></div>
         </div>
    </div>

    <div class="title">
        <h4>{{ $user->fullname }} | Lastest Answers</h4>        
    </div>
    <div class="row">
    <div class="col-lg-7">


    @if (!$questions) {
        <h3>There is no questions for show</h3>
    @endif


    @foreach($questions as $question)
        <div class="question-block" >
       
            <div class="question">
                <h3>{{ $question->content }}</h3>
            </div>
       
            <div class="answer">
                <p>{{ $question->answer['content']}}</p>
            </div>
            <hr>
       
            <div class="options" data-id="{{ $question->id }}" data-liked="0">
                <button class="btn btn-info btn-xs like">Like</button>

                @if ($user->id === $currentAuth->id)
                    <form action="{{ URL::to('/') . '/answer/delete' }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <input type="submit" value="Delete" >
                    </form>

                @endif

            </div>

            <div class="time">
                {{ $question->answer['created_at']}}
            </div>
        </div>

    @endforeach
    </div>
        <div class="col-lg-3 ask">
            <h4> <b>Ask  {{ '@' . $user->username . ':'}} </b></h4>
            <div class="askform">
                <form action="{{ URL::to('/') .  '/question'}}" method="POST">
                    {{ csrf_field() }}

                    <textarea name="content" placeholder="What, When, Why... ask" class="form-control txt" required="required"></textarea>
                    <br>
                    <input type="hidden" name="receiver" value="{{ $user->id }}" >
                    <span class="counter">140</span>
                   <br>
                    <input type="checkbox" name="status" value="anonymously"> Ask Anonymously
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Ask" class="btn btn-primary" class="submit">
                    </div>
                        <div class="error">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('script')

        var token = '{{ Session::token() }}';
        var urlLike   = '{{ URL::to('/') . '/answer/like'}}';
@stop
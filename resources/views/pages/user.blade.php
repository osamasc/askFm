@extends('layouts.master')

@section('title', $user->fullname . ' (@' . $user->username . ')')

@section('content')

<div class="row">
    <div class="cover col-lg-8" id="cover">
    <img src="{{ URL::to('/') . '/uploads/images/cover/' . $user->cover }}">
    <span>{{ $user->fullname }}</b> <br> {{ '@' . $user->username   }}</span>
    <i class="fa fa-camera" aria-hidden="true"></i>
        @if ($user->id != $currentAuth->id)
        <div class="relation">
        <button data-followed="{{ $followed }}" data-id="{{ $user->id }}" class="btn btn-sm btn-info fuck">{{ ($followed != 1) ? 'Follow' : 'Unfollow' }}</button>
        </div>
        @endif

    </div>

    <div class="col-lg-3 ask-new-question">
        <h4>Ask  {{ '@' . $user->username . ':'}}</h4>
                
                <form action="{{ URL::to('/') .  '/question'}}" method="POST">
                
                    {{ csrf_field() }}

                    <textarea name="content" placeholder="What, When, Why... ask" class="form-control txt" required="required" rows="4"></textarea>
                   
                    <input type="hidden" name="receiver" value="{{ $user->id }}" >
                    
                    <div class="ask-new-question-options">
                        <div class="col-md-8">
                            <input type="checkbox" name="status" value="anonymously"> Ask Anonymously
                        </div>
                       
                        <div class="col-md-">
                            <span class="counter">140</span>
                            <input type="submit" value="Ask" class="btn btn-info btn-sm" class="submit">
                        </div>
                    </div>
                    
                </form>
    </div>
</div>

<div class="row">
    <div class="under-cover-options">
        <ul>
            <li>{{ $answerCount }} Answers</li>
            <li>About</li>
            <li>Likes</li>
            <li>Report</li>
        </ul>
    </div>    
</div>

<div class="profile">
    <img src="{{ URL::to('/') . '/uploads/images/profile/' . $user->photo }}">
    <i class="fa fa-camera" aria-hidden="true"></i>
</div>

    
<div class="user-lastest-answer col-md-9">
    <h4>{{ $user->fullname }} | Lastest Answers</h4>            
</div>

<div class="row if-no-questions">
    <div class="col-md-9">
        
        @foreach($questions as $question)
        
        <div class="post">
        <div class="col-xs-12">
            <div class="post-photo col-xs-3"></div>
            <div class="col-xs-9 post-details">
                <div>{{ $user->fullname }}</div>
                <div>{{ $question->answer['created_at']}}</div>
            </div>
        </div>
        <div class="post-paragraph">
            <p>{{ $question->content }}</p>
        </div>
        <div class="post-paragraph">
            <p>{{ $question->answer['content']}}</p>
        </div>

        <hr>
        <div class="controllers options" data-id="{{ $question->id }}" data-liked="0">
            <i class="fa fa-heart" aria-hidden="true"></i> <span class="like">Like</span>
            <i class="fa fa-retweet" aria-hidden="true"></i> <span> Share</span>

            @if ($user->id === $currentAuth->id)
                 <i class="fa fa-close" aria-hidden="true"></i> <span class="remove">Remove</span>
            @endif

        </div>
    </div>


        
    @endforeach
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="profile-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Profile Upgrade</h4>
      </div>
      <div class="modal-body">
<form method="POST" action="{{ asset('profile/upload')}}"  enctype="multipart/form-data">
{{ csrf_field() }}
        <input type="hidden" name="type" value="profile-pic">
        <input type="file" name="image" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload Pic</button>
</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="cover-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cover Upgrade</h4>
      </div>
      <div class="modal-body">
<form method="POST" action="{{ asset('profile/upload')}}"  enctype="multipart/form-data">
{{ csrf_field() }}
        <input type="hidden" name="type" value="cover-pic">
        <input type="file" name="image" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload Cover</button>
</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



    
@stop

@section('script')

        var token = '{{ Session::token() }}',
            urlLike   = '{{ URL::to('/') . '/answer/like'}}',
            relationUrl = '{{ URL::to('/') . '/relations'}}',
            urlDelete   = '{{ URL::to('/') . '/answer/delete' }}';

@stop
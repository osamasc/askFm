@extends('layouts.master')

@section('title', 'Ask @' . $user->username)

@section('content')

<div class="question">
            <h4> <b>Ask  {{ '@' . $user->username . ':'}} </b></h4>
            <div class="askform">
                <form action="{{ URL::to('/') .  '/question'}}" method="POST">
                    {{ csrf_field() }}

                    <textarea name="content" placeholder="What, When, Why... ask" class="form-control" required="required"></textarea>
                    <br>
                    <input type="hidden" name="receiver" value="{{ $user->id }}">
                    <input type="checkbox" name="status" value="anonymously"> Ask Anonymously
                    <br>
                    <div class="form-group">
                        <input type="submit" value="Ask" class="btn btn-primary">
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

@stop 
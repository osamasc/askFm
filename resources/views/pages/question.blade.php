@extends('layouts.master')

@section('title', 'Inbox')

@section('content')
    
    <div class="Inbox col-md-7">
        <div class="question"><b>{{ $question->content }}</b></div>
        <div class="answer">
            <form method="POST" action="{{ URL::to('/') . '/account/question'}}"> 
                {{ csrf_field() }}

                <div class="form-group">
                    <textarea placeholder="What is your answer?" name="answer" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{ $question->id}}">
                    <input type="submit" value="answer">
                </div>
            </form>
        </div>
    </div>

@stop   
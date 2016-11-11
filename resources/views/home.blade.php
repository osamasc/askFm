@extends('layouts.master')

@section('title', 'Home')

@section('content')
    
    <div class="row">
        <div class="col-lg-7 question-block">
            <div class="question">
                <h3>This is a question</h3>
            </div>
            <div class="answer">
                <p>This is an answer</p>
            </div>
            <hr>
            <div class="options">
                <button class="btn btn-info btn-xs">Like</button>
                <button class="btn btn-primary btn-xs">Report</button>
                <button class="btn btn-success btn-xs">Share</button>
            </div>
            <div class="user">
                username
            </div>
            <div class="time">
                20:43 PM
            </div>
        </div>
        <div class="col-lg-3 ask">
            <h4>Ask Your Friend !</h4>
            <div class="askform">
                <form action="" method="POST">
                    <textarea name="question" placeholder="type your question here" class="form-control">
                        
                    </textarea>
                    <input type="checkbox" name="status" value="anonymously"> Ask Anonymously
                </form>
            </div>
        </div>
    </div>

@stop
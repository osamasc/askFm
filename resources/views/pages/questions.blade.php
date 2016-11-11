@extends('layouts.master')

@section('title', 'Questions')

@section('content')
<div class="user-questions">
    
    <div class="title">
        <h3>Questions <span>{{ $count}}</span></h3>
        <span></span>    
    </div>
   
    <div class="body col-lg-9">    
        <table class="table body-question">
            @foreach($questions as $question)
                <tr>
                    <th><b>{{ $question->content }}</b></th>
                    <th>{{ $question->created_at }}</th>
                    <td>
                        <form method="POST" action="{{ URL::to('/') . '/account/delete'}}">
                            {{ csrf_field()}}
                            <input type="hidden" name="id" value="{{ $question->id }}">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                    <td>
                     <a href="{{ URL::to('/') . '/account/question/' . $question->id }}" class="btn btn-success btn-sm">Answer</a>

                    </td>
                    <td>
                        {{ ($question->anonymous === 0 ) ? $question->user->fullname .'(@' . $question->user->username . ')' : 'anonymous' }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

</div>
@stop
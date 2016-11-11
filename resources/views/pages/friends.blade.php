@extends('layouts.master')

@section('title', 'Friends')

@section('content')
    <div class="friends col-md-12">
       
        <div class="search col-md-6" >
            <h3>search peaple by keywords</h3> 
            <input type="text" class="form-control" placeholder="Type name here !">
            <div class="output"></div>
        </div>
       
        <div class="list col-md-6">
            <table class="table">
                   <h4>Your Friends List</h4>
                    @foreach($friends as $friend)
                        <tr>
                            <td><a href="{{ URL::to('/') . '/' . $friend->followed->username }}">{{$friend->followed->fullname}}  {{ '(@' .$friend->followed->username. ')' }}</a> </td>
                            <td><a href="{{ URL::to('/') . '/' . $friend->followed->username .'/ask' }}">ask</a></td>
                        </tr>
                    @endforeach
            </table>    
        </div>
        
    </div>
@stop

@section('script')
    var urlSearch = '{{ asset('/search') }}',
        _token = '{{ Session::token() }}';

@stop
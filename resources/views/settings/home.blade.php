@extends('layouts.master')

@section('title', 'Settings')

@section('content')
    <div class="settings col-lg-offset-2 col-lg-7">
        
        <table class="table">
           <h3>User Settings</h3>
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
                <td>
                    <button class="btn btn-xs btn-info">Edit</button>
                </td>
            </tr>

        </table>

        <h3>Update info</h3>
        <hr>

        <form method="POST" action="{{ URL::to('/') . '/account/settings'}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input class="form-control" type="text" name="fullname" value="{{ $user->fullname }}">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender">
                    <option value="1" {{ ( $user->gender === 1 ) ? 'selected' : ''}} >Mail</option>
                    <option value="2" {{ ( $user->gender === 2 ) ? 'selected' : ''}}>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <textarea name="location" placeholder="Descripe Your Location Here" class="form-control">{{ @$user->about->location }}</textarea>
            </div>

            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" placeholder="A little information about yourself" class="form-control">{{ @$user->about->bio }}</textarea>
            </div>

            <div class="form-group">
                <label for="web">Web</label>
                <input type="text" name="web" placeholder="Add your web page link.." class="form-control" value="{{ @$user->about->location }}">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info">
            </div>
        </form>

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
</div>
@stop
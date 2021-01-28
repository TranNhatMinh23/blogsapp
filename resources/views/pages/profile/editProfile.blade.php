@extends('layouts.app')

@section('title', 'update profile')

@section('content')
    <div class="container">
        {{ $profile }}      
        <div class="profile">
            <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avarta">
                <input type="submit" value="Cập nhật">
            </form>
        </div>
    </div>
@endsection
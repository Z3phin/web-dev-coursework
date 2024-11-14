@extends('layouts.app')

@section('title', 'Forums')

@section('content')
    <ul>
        @foreach ($forums as $forum)
            <li><a href="{{route('forums.show', ['id' => $forum->id])}}">{{$forum->name}}</a></li>
        @endforeach
    </ul>
@endsection
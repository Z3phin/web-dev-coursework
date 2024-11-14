@extends('layouts.app')

@section('title', 'Forums')

@section('content')
    <ul>
        @foreach ($forums as $forum)
            <li>{{$forum->name}}</li>
        @endforeach
    </ul>
@endsection
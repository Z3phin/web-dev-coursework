@extends('layouts.app')

@section('title', $forum->name)

@section('content')
    <ul>
        @if($forum->owner_id)
        <li>
             {{$forum->owner->username}}       
        </li>
        @endif
        <li>
            {{$forum->description}}
        </li>
    </ul>
    <hr>
    <section>
        <ul>
        @foreach ($forum->posts as $post)
            <li>{{$post->title}}</li>
        @endforeach
        </ul>
    </section>
@endsection
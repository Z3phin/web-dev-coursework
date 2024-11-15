@extends('layouts.app')

@section('title', $forum->name)

@section('content')
    <section>
        <ul>
            @if($forum->owner_id)
            <li>
                 {{$forum->owner->username}}       
            </li>
            @endif
            <li>
                {{$forum->description}}
            </li>
            <a href="{{route('forums.index')}}">Back to all forums</a>
        </ul>
    </section>
    <hr>
    <section>
        <ul>
        @foreach ($forum->posts as $post)
            <li>
                <a href="{{route('post.show', ['id' => $post->id])}}">{{$post->title}}</a>
                <ul>
                    <li>{{$post->activity->appUser->username}}</li>
                    <li>{{$post->created_at}}</li>
                    <li>{{$post->activity->like_count}}</li>
                    <li>{{$post->activity->dislike_count}}</li>
                </ul>
            </li>
        @endforeach
        </ul>
    </section>
@endsection
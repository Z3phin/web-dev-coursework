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
            <a style="text-decoration: none; text-color: black;" href="{{route('post.show', ['id' => $post->id])}}">
                <x-activities.post
                title="{{$post->title}}"
                username="{{$post->activity->appUser->username}}"
                likes="{{$post->activity->like_count}}"
                dislikes="{{$post->activity->dislike_count}}"
                date="{{$post->created_at}}">

                </x-activities.post>
            </a>
        @endforeach
        </ul>
    </section>
@endsection
@extends ('layouts.app')

@section ('title', $post->title)

@section('content')
    <section>
        <a href="{{route('forums.show', ['id' => $post->forum_id])}}">Back to {{$post->forum->name}}</a>
    </section>
    <section>
        <div style='width=0.7vw; float:left;'>
            <p>{{$post->activity->body}}</p>
        </div>
        <div style='width=0.3vw; float:right;'>
            <ul>
                <li>{{$post->activity->appUser->username}}</li>
                <li>{{$post->created_at}}</li>
            </ul> 
        </div>   
    </section>
    <section style='clear:both'>
        <hr>
        <p>Comments</p>

        @forelse ($post->comments as $comment)
            <x-activities.comment
             username="{{$comment->activity->appUser->username}}" 
             likes="{{$comment->activity->like_count}}"
             dislikes="{{$comment->activity->dislike_count}}"
             date="{{$comment->created_at}}"
             >
                {{$comment->activity->body}}
            </x-activities.comment>
            
        @empty
            <p>No comments here yet. Do you have something to say?</p>
        @endforelse
    
    <section>
    <span></span>
@endsection
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
    <span></span>
@endsection
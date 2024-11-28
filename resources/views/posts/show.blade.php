{{-- @extends ('layouts.app')

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
@endsection --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$post->title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{$post->activity->body}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
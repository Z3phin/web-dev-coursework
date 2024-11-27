{{-- @extends('layouts.app')

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
@endsection --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($forum->name) }}
        </h2>
    </x-slot>

    <section class="flex flex-row py-12">
        <section  class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative">
            @foreach ($forum->posts as $post)
            <div class="py-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 my-4">
                        <p class="py-2">
                            {{'@' . $post->activity->appUser->username . ' | ' . $post->created_at }}
                        </p>
                        <h2 class="py-4">{{$post->title}}</h2>
                        <span>
                            <button class="px-2">
                                {{$post->activity->like_count . ' likes'}}
                            </button>
                            <button class="px-2">
                                {{$post->activity->dislike_count . ' dislikes'}}
                            </button>
                            <button class="px-2">
                                {{$post->activity->comments->count() . ' comments'}}
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </section>   
        <section class="max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 my-4">
                    <h2>{{$forum->name}}</h2>
                    @if($forum->owner)
                        <p><{{$forum->owner->username}}</p>
                    @endif
                    <p>{{$forum->description}}</p>
                    <p>{{$forum->members->count()}}</p>
                </div>
            </div>
        </section>
    </section>
</x-app-layout>

{{-- <?xml version="1.0" ?><svg height="1792" viewBox="0 0 1792 1792" width="1792" xmlns="http://www.w3.org/2000/svg"><path d="M320 1344q0-26-19-45t-45-19q-27 0-45.5 19t-18.5 45q0 27 18.5 45.5t45.5 18.5q26 0 45-18.5t19-45.5zm160-512v640q0 26-19 45t-45 19h-288q-26 0-45-19t-19-45v-640q0-26 19-45t45-19h288q26 0 45 19t19 45zm1184 0q0 86-55 149 15 44 15 76 3 76-43 137 17 56 0 117-15 57-54 94 9 112-49 181-64 76-197 78h-129q-66 0-144-15.5t-121.5-29-120.5-39.5q-123-43-158-44-26-1-45-19.5t-19-44.5v-641q0-25 18-43.5t43-20.5q24-2 76-59t101-121q68-87 101-120 18-18 31-48t17.5-48.5 13.5-60.5q7-39 12.5-61t19.5-52 34-50q19-19 45-19 46 0 82.5 10.5t60 26 40 40.5 24 45 12 50 5 45 .5 39q0 38-9.5 76t-19 60-27.5 56q-3 6-10 18t-11 22-8 24h277q78 0 135 57t57 135z"/></svg> --}}
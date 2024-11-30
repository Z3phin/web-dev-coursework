<x-app-layout>
    <x-slot name="header">
        <div class="text-gray-800 dark:text-gray-200">
            <div>
                <a href="{{route('forums.show', ['id' => $post->forum_id])}}">{{'← ' . $post->forum->name}}</a>
            </div>
            <div>
                <a href="{{route('forums.show', ['id' => $post->forum_id])}}" 
                    >
                    {{'@' . $post->activity->appUser->username}}
                </a>
                <span>{{' |' . $post->created_at}}</span>
            </div>
            <h2 class="py-2 font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{$post->title}}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{$post->activity->body}}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
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

        <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <hr>
        </div>

        @auth
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">

            <!-- Adding a Comment -->
            <form method="POST" action="{{route('comment')}}">
                @csrf
                <div>
                    <input type="hidden" id="activity_id" name="activity_id" value="{{$post->activity->id}}" >
                    <x-input-label for="body" :value="__('Comment')"/>
                    <x-text-area id="body" name="body" cols="1" rows="1" class="block mt-1 w-full" :value="old('body')" autofocus/>

                </div>

                <div class="py-2">
                    <x-primary-button >
                        {{ __('Post') }}
                    </x-primary-button>
                </div>
                
            </form>
        </div>
        @else
        <div class="text-gray-900 dark:text-gray-100 m-4">
            <a href="{{route('login')}}">Sign in to comment on this post.</a>
        </div>
        @endauth

        @php
            $comments = $post->comments->load('activity.appUser');
        @endphp
        @forelse($comments as $comment)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 m-4">
                        <p class="py-2">
                            {{'@' . $comment->activity->appUser->username . ' | ' . $comment->created_at }}
                        </p>
                        <p>
                            {{$comment->activity->body}}
                        </p>    
                        <span>
                            <button class="px-2">
                                {{$comment->activity->like_count . ' likes'}}
                            </button>
                            <button class="px-2">
                                {{$comment->activity->dislike_count . ' dislikes'}}
                            </button>
                            <button class="px-2">
                                {{$comment->activity->comments->count() . ' comments'}}
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <p>No comments here yet. Do you have something to say?</p>
        @endforelse
    </div>

    
</x-app-layout>
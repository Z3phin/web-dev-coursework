<x-app-layout>
    <x-slot name="header">
        <div class="text-gray-800 dark:text-gray-200">
            <div>
                <a href="{{route('forums.show', ['forum' => $post->forum])}}">{{'← ' . $post->forum->name}}</a>
            </div>
            <div>
                <a href="{{route('forums.show', ['forum' => $post->forum])}}" 
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
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{$post->activity->body}}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <span>

                        @livewire('like-button', ['activity' => $post->activity])
                        @livewire('dislike-button', ['activity' => $post->activity])
                        <button class="px-2">
                            {{$post->activity->comments->count() . ' comments'}}
                        </button>
                    </span>
                </div>
            </div>
        </section>

        <section>
            <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <hr>
            </div>

            @livewire('create-comment', ['parentActivity' => $post->activity])

            @php
                $comments = $post->comments->load('activity.appUser');
            @endphp
            @forelse($comments as $comment)

                @livewire('commentItem', ['comment' => $comment])
            @empty
                <p>No comments here yet. Do you have something to say?</p>
            @endforelse
        </section>
    </div>

    
</x-app-layout>
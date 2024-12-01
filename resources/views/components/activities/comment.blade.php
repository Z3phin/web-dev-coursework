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
                @livewire('like-button', ['activity' => $comment->activity])
                @livewire('dislike-button', ['activity' => $comment->activity])
                <button class="px-2">
                    {{$comment->activity->comments->count() . ' comments'}}
                </button>
            </span>
        </div>
    </div>
</div>
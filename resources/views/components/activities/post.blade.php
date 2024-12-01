<div class="py-2">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 my-4">
            <p class="py-2">
                @php
                    $user = $post->activity->appUser
                @endphp
                <a href="{{route('appUser.show', ['appUser' => $user])}}">{{'@' . $user->username}}</a>
                <span>
                    {{' | ' . $post->created_at }}
                </span>
            </p>
            <a href="{{route('posts.show', ['post' => $post])}}">
                <h2 class=" text-2xl py-4">
                    <strong>
                        {{$post->title}}
                    </strong>
                </h2>
            </a>
            <span>

                @livewire('like-button', ['activity' => $post->activity])
                @livewire('dislike-button', ['activity' => $post->activity])
                <button class="px-2">
                    {{$post->activity->comments->count() . ' comments'}}
                </button>
            </span>
        </div>
    </div>
</div>
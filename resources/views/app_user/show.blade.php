<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($appUser->username) }}
        </h2>
        <p>{{$appUser->status}}</p>
    </x-slot>

    <div class="w-screen py-12 flex">
        <div class="w-full min-w-2xl max-w-7xl mx-6 flex-auto">
            <div class="mx-6 px-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Welcome to " . $appUser->username .  "'s page") }}
                    </div>
                </div>
    
                <!-- Activity Feed --> 
                
                <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <section>
                            <h1>Activity Feed</h1>
                            <nav>
                                <x-nav-link :href="route('appUser.show', ['appUser' => $appUser])" :active="request()->routeIs('appUser.show')">
                                    {{ __('Overview') }}
                                </x-nav-link>
                                <x-nav-link :href="route('appUser.show.posts', ['appUser' => $appUser])" :active="request()->routeIs('appUser.show.posts')">
                                    {{ __('Posts') }}
                                </x-nav-link>
                                <x-nav-link :href="route('appUser.show.comments', ['appUser' => $appUser])" :active="request()->routeIs('appUser.show.comments')">
                                    {{ __('Comments') }}
                                </x-nav-link>
                            </nav>
                        </section>
                    </div>
                </div>

                <div>
                    @if(request()->routeIs('appUser.show'))

                        @foreach ($appUser->activities->load('commentable') as $activity)
                            @if($activity->commentable_type == 'App\Models\Post')
                                <x-activities.post :post='$activity->commentable'/>
                            @elseif ($activity->commentable_type == 'App\Models\Comment') 
                                <x-activities.comment :comment='$activity->commentable'/>
                            @endif
                        @endforeach

                    @elseif(request()->routeIs('appUser.show.posts'))
                        @foreach($appUser->posts->load('activity') as $post )
                            <x-activities.post :post='$post'/>
                        @endforeach

                    @elseif(request()->routeIs('appUser.show.comments'))
                        @foreach($appUser->comments->load('activity') as $comment )
                            <x-activities.comment :comment='$comment'/>
                        @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="w-1/4 max-w-xl flex-auto mx-4">
            <div class=" mx-6 pr-6">
                <div class="bg-white dark:bg-gray-800 overflow-visible shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <!-- Username -->
                        <h1 class="text-center">{{$appUser->username}}</h1>
                        <!-- Follow/Followers -->
                        <hr>
                        <div class="flex">
                            <span class="text-center flex-1">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div>
                                                <p>Following</p>
                                                <p>{{$appUser->following->count()}}</p>
                                            </div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach ($appUser->following as $follow)
                                            <x-dropdown-link :href="route('appUser.show', ['appUser' => $follow])">
                                                {{$follow->username}}
                                            </x-dropdown-link>
                                        @endforeach
                                    </x-slot>
                                </x-dropdown>
                            </span>
                            <span class="text-center flex-1">
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div>
                                                <p>Followers</p>
                                                <p>{{$appUser->followers->count()}}</p>
                                            </div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach ($appUser->followers as $follower)
                                            <x-dropdown-link :href="route('appUser.show', ['appUser' => $follow])">
                                                {{$follower->username}}
                                            </x-dropdown-link>
                                        @endforeach
                                    </x-slot>
                                </x-dropdown>
                            </span>
                        </div>
                        
                        <!-- About -->
                        <div>
                            <hr>
                            <h2 class="mt-2 text-center">About</h1>
                            <p class="w-full my-4">
                                {{$appUser->about}}
                            </p>
                        </div>
                        <!-- Stats and Facts -->
                        <div class="mt-2">
                            <hr>
                            <div class="w-full">
                                <div class="text-center mt-2">
                                    <h2>Level</h2>
                                    <p>{{$appUser->level}}</p>
                                </div>
                                <div class="text-center mt-2">
                                    <h2>XP Count</h2>
                                    <p>{{$appUser->xp_count}}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Owns these Forums -->
                        @if($appUser->ownForums()->exists())
                        <div>
                            <hr>
                            <h2>Owner of these Forums</h2>
                            @foreach($appUser->ownForums as $forum)
                            <div class="w-full my-2">
                                <a href="{{route('forums.show', ['forum' => $forum])}}">
                                    {{$forum->name}}
                                </a>
                            </div>
                            @endforeach        
                        </div>
                        @endif

                        <!-- Moderator Of -->
                        @if($appUser->moderatorOf()->exists())
                        <div>
                            <hr>
                            <h2>Moderator of these Forums</h2>
                            @foreach($appUser->moderatorOf as $forum)
                            <div class="w-full">
                                <a href="{{route('forums.show', ['forum' => $forum])}}">
                                    {{$forum->name}}
                                </a>
                            </div>
                            @endforeach        
                        </div>
                        @endif
                        <!-- Member of -->

                        @if($appUser->memberOf()->exists())
                        <div>
                            <hr>
                            <h2>Member of these Forums</h2>
                            @foreach($appUser->memberOf as $forum)
                            <div class="w-full">
                                <a href="{{route('forums.show', ['forum' => $forum])}}">
                                    {{$forum->name}}
                                </a>
                            </div>
                            @endforeach        
                        </div>
                        @endif
                        
                        @auth
                        @php
                            $user = Auth::user()->appUser;
                            $canEdit = $appUser->is($user)
                        @endphp
                            @if($canEdit)
                            <hr>
                            <form class="text-center mt-4" method="GET" action="{{route('forums.index')}}">
                                <x-primary-button>Edit Profile</x-primary-button>
                            </form>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
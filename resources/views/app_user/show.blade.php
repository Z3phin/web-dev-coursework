<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($appUser->username) }}
        </h2>
    </x-slot>

    <div class="w-screen py-12 flex">
        <div class="w-3/4 mx-6 flex-auto">
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
                            <a href="{{route('appUser.show', ['appUser' => $appUser])}}">
                                Overview
                            </a>
                            <a href="{{route('appUser.show', ['appUser' => $appUser])}}">
                                Posts
                            </a>
                            <a href="{{route('appUser.show', ['appUser' => $appUser])}}">
                                Comments
                            </a>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/4 flex-auto shrink-0 ">
            <div class=" mx-6 pr-6">
                <div class="bg-white dark:bg-gray-800 overflow-visible shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <!-- Username -->
                        <p class="text-center">{{$appUser->username}}</p>
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
                        
                        <!-- Status -->
                        <!-- Description -->
                        <!-- Stats and Facts -->
                        <!-- Owns these Forums -->
                        <!-- Moderator Of -->
                        <!-- Member of -->
                        

                    </div>
                </div>
            </div>
            
        </div>

    </div>


</x-app-layout>
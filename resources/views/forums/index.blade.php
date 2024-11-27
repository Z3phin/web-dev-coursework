{{-- @extends('layouts.app')

@section('title', 'Forums')

@section('content')
    <ul>
        @foreach ($forums as $forum)
            <li><a href="{{route('forums.show', ['id' => $forum->id])}}">{{$forum->name}}</a></li>
        @endforeach
    </ul>
@endsection --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Forums') }}
        </h2>
    </x-slot>

    @foreach ($forums as $forum)
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 " >
            <div class="bg-white
             dark:bg-gray-800    
               overflow-hidden 
               shadow-sm 
               sm:rounded-lg" >
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{route('forums.show', ['id' => $forum->id])}}">
                       <strong> {{$forum->name}} </strong>
                    </a>
                    <p class="py-1">{{$forum->description}}</p>
                    <p class="text-right">{{$forum->members->count() . " members"}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
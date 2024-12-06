<div>
    @auth
        @if($isFollowing)
            <x-secondary-button 
            wire:click="leave"
            wire:confirm="Are you sure you would like to leave this forum?"
            >
                Leave
            </x-secondary-button>
        @else
            <x-primary-button wire:click="join">
                Join
            </x-primary-button>
        @endif
    @else
        <form method="GET" action="{{route('login')}}">
            @csrf
            <x-primary-button>
                Join
            </x-primary-button>
        </form>
    @endauth
</div>

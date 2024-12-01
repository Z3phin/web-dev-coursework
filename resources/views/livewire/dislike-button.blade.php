<span>
    @if($isDisliked)
    <x-secondary-button wire:click="click">⇣</x-secondary-button>
    @else
    <x-secondary-button wire:click="click">⇩</x-secondary-button>
    @endif
    <span>{{$activity->dislike_count}}</span>
</span>

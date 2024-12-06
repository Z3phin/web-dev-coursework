<div>
    {{-- Temporary --}}
    <x-activities.post :post="$post"/>
    @auth
        @if($canDelete)
        <div>
            <x-danger-button 
            wire:click="delete"
            wire:confirm="Are you sure you would like to delete tis post?">
                delete
            </x-danger-button>
        </div>  
        @endif
    @endauth  
    
</div>

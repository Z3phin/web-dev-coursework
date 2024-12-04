<div>
    @if($isHidden)
    <x-primary-button wire:click="toggleHide" class="h-16 w-full justify-center">
         + Create Post
    </x-primary-button>
    @else
    <section class="bg-white dark:bg-gray-800 border border-solid border-gray-800 dark:border-white shadow-sm sm:rounded-lg">
        <form wire:submit="createPost">
            @csrf
            <!-- Title -->
            <div class="px-2">
                <x-input-label for="title" :value="__('Title')" class="mt-2"/>
                <x-text-input class="w-3/4 mt-2" id="title" name="title" wire:model='title' required autofocus/>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            
            <!-- Body -->
            <div class="px-2">
                <x-text-area class="w-full mt-2" id="body" name="body" wire:model="body" required autofocus/>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>     

            <div class="px-2 mb-2">      
                <x-secondary-button wire:click="toggleHide">
                    Cancel
                </x-secondary-button>
                <x-primary-button>
                    POST
                </x-primary-button>
            </div>  
        </form>    
    </section>
    @endif
</div>


<section class="w-3/4 max-w-40xl mx-auto sm:px-6 lg:px-8 flex-auto">
    @auth
        @if($canPost)
            @livewire('create-post-box', ['forum' => $forum])
        @endif
    @endauth
    <div>
        <hr>
    </div>
    <section>
        @foreach($posts as $post)
            @livewire('post-item', ['post' => $post], key($post->id))
        @endforeach
    </section>  
</section>


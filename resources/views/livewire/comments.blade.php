<section class="w-3/4 max-w-40xl mx-auto sm:px-6 lg:px-8 flex-auto">
    @auth
        @livewire('create-comment', ['activity' => $activity])
    @endauth
    <section>
        @foreach($comments as $comment)
            @livewire('comment-item', ['comment' => $comment], key($comment->id))
        @endforeach
    </section>  
</section>

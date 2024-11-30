<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'activity_id' => 'required|exists:activities,id'
        ]);

        $comment = new Comment();
        $comment->parent_activity_id = $request->activity_id;
        $comment->save();

        $activity = new Activity();
        $activity->app_user_id = $request->user()->appUser->id;
        $activity->commentable_type = "App\Models\Comment";
        $activity->commentable_id = $comment->id;
        $activity->body = $request->body;
        $activity->like_count = 0;
        $activity->dislike_count = 0;
        $activity->save();

        // temporary solution
        return redirect(route('posts.show', ['post' => Post::findOrFail($request->activity_id)]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

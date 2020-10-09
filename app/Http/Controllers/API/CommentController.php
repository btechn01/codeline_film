<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->getAuthIdentifier();
        $item = [
            'user_id' => $user_id,
            'film_id' => $request->get('film_id'),
            'comment' => $request->get('comment')
        ];
        $comment = Comment::query()->create($item);
        $comment = Comment::query()->with('user')->find($comment->getAttribute('id'));
        return response()->json($comment, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Comment $comment
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

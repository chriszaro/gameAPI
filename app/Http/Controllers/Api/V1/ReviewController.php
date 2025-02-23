<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\V1\StoreReviewRequest;
use App\Http\Requests\V1\UpdateReviewRequest;
use App\Http\Resources\V1\GameCollection;
use App\Http\Resources\V1\ReviewCollection;
use App\Models\Game;
use App\Models\review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, Game $game)
    {

        $user = $request->user();
        $user_id = $user->id;

        $review = new Review();
        $review->rating = $request->get('rating');
        $review->comment = $request->get('comment');
        $review->user_id = $user_id;
        $review->game_id = $game->id;

        $review->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}

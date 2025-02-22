<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Resources\V1\GameResource;
use App\Http\Resources\V1\GameCollection;
use App\Filters\V1\GameFilter;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     * return /api/v1/games
     */
    public function index(Request $request)
    {
        $filter = new GameFilter();
        $queryItems = $filter->transform($request);

        return new GameCollection(Game::where($queryItems)->get());


        //Game::where([['column', 'operator', 'value']]);
        //Game::where([['genre', 'like', '%' . $queryItems[0] . '%']]);

//        return new GameCollection(Game::paginate());
        //return new GameCollection(Game::all());
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
    public function store(StoreGameRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * return /api/v1/games/id
     */
    public function show(Game $game)
    {
        return new GameResource($game);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}

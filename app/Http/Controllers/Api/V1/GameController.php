<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\GameFilter;
use App\Http\Requests\V1\StoreGameRequest;
use App\Http\Requests\V1\UpdateGameRequest;
use App\Http\Resources\V1\GameCollection;
use App\Http\Resources\V1\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        return new GameResource(Game::create($request->all()));
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
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
    }
}

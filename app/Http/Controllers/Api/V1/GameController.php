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
        $filterItems = $filter->transform($request);

        $user = $request->user();
        $user_id = $user->id;
        $filterItems[] = ['user_id', '=', $user_id];

        $sort = $request->query('sort');
        if (isset($sort)){
            return new GameCollection(Game::where($filterItems)->orderBy('release_date', $sort)->get());
        }
        else {
            return new GameCollection(Game::where($filterItems)->get());
        }

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
        $user = $request->user();
        $user_id = $user->id;

        $game = new Game();
        $game->title = $request->get('title');
        $game->description = $request->get('description');
        $game->release_date = $request->get('releaseDate');
        $game->genre = $request->get('genre');
        $game->user_id = $user_id;
        $game->save();

        return new GameResource($game);
    }

    /**
     * Display the specified resource.
     * return /api/v1/games/id
     */
    public function show(Game $game)
    {
        $user = request()->user();
        $user_id = $user->id;

        if ($game->user_id == $user_id)
            return new GameResource($game);
        else
            return response()->json(['message' => 'You cannot view another user\'s game'], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $user = request()->user();
        $user_id = $user->id;
        if ($game->user_id == $user_id){
            $game->update($request->all());
            return new GameResource($game);
        }
        else
            return response()->json(['message' => 'You cannot update another user\'s game'], 401);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $user = request()->user();
        $user_id = $user->id;
        if ($game->user_id == $user_id || $user->role == 'Admin') {
            $game->delete();
            return response()->json(['message' => 'Deletion was successful'], 200);
        }
        else
            return response()->json(['message' => 'You cannot delete another user\'s game'], 401);
    }
}

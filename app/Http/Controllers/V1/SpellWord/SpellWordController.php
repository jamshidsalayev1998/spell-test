<?php

namespace App\Http\Controllers\V1\SpellWord;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SpellWord\StoreSpellWordRequest;
use App\Http\Requests\V1\SpellWord\UpdateSpellWordRequest;
use App\Http\Resources\V1\SpellWord\IndexSpellWordResource;
use App\Models\V1\SpellWord;
use Illuminate\Http\Request;

class SpellWordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $words = SpellWord::query()->mine()->filter($request->filters)->get();
        return ResponseHelper::success('Words', 200, IndexSpellWordResource::collection($words));
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
    public function store(StoreSpellWordRequest $request)
    {
        $user = auth()->user();
        $newWord = SpellWord::create([
            'word' => $request->word,
            'translate' => $request->translate,
            'folder_id' => $request->folder_id,
            'user_id' => $user->id
        ]);
        return ResponseHelper::success('Created', 201, new IndexSpellWordResource($newWord));
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
    public function update(UpdateSpellWordRequest $request, SpellWord $spellWord)
    {
        $user = auth()->user();
        if ($spellWord->user_id != $user->id) {
            return ResponseHelper::error('Not permission', 403);
        }
        $spellWord->word = $request->word;
        $spellWord->translate = $request->translate;
        $spellWord->update();
        return ResponseHelper::success('Updated' , 200 , new IndexSpellWordResource($spellWord));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpellWord $spellWord)
    {
        $user = auth()->user();
        if ($spellWord->user_id != $user->id) {
            return ResponseHelper::error('Not permission', 403);
        }
        $spellWord->delete();
        return ResponseHelper::success('Deleted' , 200 , new IndexSpellWordResource($spellWord));
    }
}

<?php

namespace App\Http\Controllers\V1\SpellTest;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SpellTest\IndexGeneralSpellTestRequest;
use App\Http\Requests\V1\SpellTest\IndexSpellTestRequest;
use App\Http\Requests\V1\SpellTest\StoreSpellTestResultRequest;
use App\Http\Resources\V1\SpellWord\IndexSpellWordResource;
use App\Models\V1\SpellTest\SpellTestResult;
use App\Models\V1\SpellTest\SpellTestResultMistake;
use App\Models\V1\SpellWord;
use Illuminate\Http\Request;

class SpellTestController extends Controller
{
    public function getTestByFolder(IndexSpellTestRequest $request)
    {
        $spellWords = SpellWord::where('folder_id' , $request->folder_id)->inRandomOrder()->get()->take($request->limit);
        return ResponseHelper::success('By folder spell test index' , 200 , IndexSpellWordResource::collection($spellWords));
    }
    public function getTestGeneral(IndexGeneralSpellTestRequest $request)
    {
        $spellWords = SpellWord::inRandomOrder()->mine()->get()->take($request->limit);
        return ResponseHelper::success('General spell test index' , 200 , IndexSpellWordResource::collection($spellWords));
    }
    public function getTestByMistakes(IndexGeneralSpellTestRequest $request)
    {
        $myMistakes = SpellTestResultMistake::mine()->pluck('spell_word_id');
        $spellWords = SpellWord::inRandomOrder()->mine()->whereIn('id' , $myMistakes)->get()->take($request->limit);
        return ResponseHelper::success('General spell test index' , 200 , IndexSpellWordResource::collection($spellWords));
    }

    public function storeTestResult(StoreSpellTestResultRequest $request)
    {
        $user = auth()->user();
        $newResult = SpellTestResult::create([
            'user_id' => $user->id,
            'count_words' => $request->count_words,
            'corrects_count' => $request->corrects_count,
            'incorrects_count' => $request->incorrects_count,
        ]);
        $mistakes = $request->mistakes;
        foreach ($mistakes as $mistake) {
            $newMistake = SpellTestResultMistake::create([
                'user_id' => $user->id,
                'spell_word_id' => $mistake,
                'spell_test_result_id' => $newResult->id
            ]);
        }
        return ResponseHelper::success('Result created' , 201 , []);
    }
}

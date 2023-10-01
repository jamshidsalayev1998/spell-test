<?php

namespace App\Http\Controllers\V1\Folder;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Folder\StoreFolderRequest;
use App\Http\Requests\V1\Folder\UpdateFolderRequest;
use App\Http\Resources\V1\Folder\IndexFolderResource;
use App\Models\V1\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $folders = Folder::query()->where('user_id', $user->id)->notDeleted()->orderBy('id', 'DESC')->get();
        return ResponseHelper::success('Folders', 200, IndexFolderResource::collection($folders));
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
    public function store(StoreFolderRequest $request)
    {
        $user = auth()->user();
        $newFolder = Folder::create([
            'user_id' => $user->id,
            'name' => $request->name
        ]);
        return ResponseHelper::success('Created', 201, new IndexFolderResource($newFolder));
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
    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $user = auth()->user();
        if ($folder->user_id != $user->id) {
            return ResponseHelper::error('Not permission', 403);
        }
        $folder->name = $request->name;
        $folder->update();
        return ResponseHelper::success('Updated' , 200 , new IndexFolderResource($folder));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $user = auth()->user();
        if ($folder->user_id != $user->id) {
            return ResponseHelper::error('Not permission', 403);
        }
        $folder->deleted = 1;
        $folder->update();
        return ResponseHelper::success('Deleted' , 200 , new IndexFolderResource($folder));
    }
}

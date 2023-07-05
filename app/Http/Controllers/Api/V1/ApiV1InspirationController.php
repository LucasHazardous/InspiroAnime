<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\InspirationGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\GenerateInspirationRequest;
use App\Models\Inspiration;
use App\Traits\HttpResponses;

class ApiV1InspirationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspirations = Inspiration::select(["id", "image"])->where("creator", auth()->user()->id)->get();
        return $this->success([
            "inspirations" => $inspirations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function generate(GenerateInspirationRequest $request)
    {
        $formData = $request->validated();
        $res = InspirationGenerate::createAndSaveImage($formData['limit'], $formData['category']);
        
        $inspiration = Inspiration::create([
            "creator" => auth()->user()->id,
            "image" => $res[0],
            "text" => $res[1],
            "source" => $res[2]
        ]);

        return $this->success([
            "inspiration" => $inspiration
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspiration $inspiration)
    {
        if($inspiration->creator == auth()->user()->id)
        return $this->success([
            "inspiration" => $inspiration
        ]);
        else
        return $this->error(null, "You are not allowed to access this resource.", 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspiration $inspiration)
    {
        if($inspiration->creator == auth()->user()->id) {
            $inspiration->delete();
            return $this->success(null,null,204);
        }
        else
        return $this->error(null, "You are not allowed to access this resource.", 403);
    }
}

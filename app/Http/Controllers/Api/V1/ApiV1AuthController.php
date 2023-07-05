<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AuthRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiV1AuthController extends Controller
{
    use HttpResponses;

    public function signIn(AuthRequest $request) {
        $user = User::where("email", $request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)) return $this->error(null, "Incorrect email or password.", 401);

        $token = $user->createToken('API_ACCESS_TOKEN')->plainTextToken;

        return $this->success([
            "token" => $token
        ]);
    }

    public function signOut(Request $request) {
        $request->user()->tokens()->delete();
        return $this->success(null, null, 204);
    }
}

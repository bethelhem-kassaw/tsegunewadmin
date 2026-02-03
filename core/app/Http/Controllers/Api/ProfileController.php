<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{


    public function userprofile()
    {
        // return response()->json([auth()->id()]);
        return response()->json([Auth::user()]);
    }


}

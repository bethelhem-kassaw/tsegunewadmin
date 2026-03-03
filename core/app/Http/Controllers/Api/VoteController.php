<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'group_product_id' => 'required|exists:group_products,id',
            'voted_by_telegram_id' => 'required'
        ]);

        // Prevent duplicate voting (CRITICAL)
        $existingVote = Vote::where('group_product_id', $request->group_product_id)
            ->where('voted_by_telegram_id', $request->voted_by_telegram_id)
            ->first();

        if ($existingVote) {
            return response()->json([
                'message' => 'You already voted'
            ], 409);
        }

        $vote = Vote::create([
            'group_product_id' => $request->group_product_id,
            'voted_by_telegram_id' => $request->voted_by_telegram_id,
        ]);

        return response()->json($vote, 201);
    }
}

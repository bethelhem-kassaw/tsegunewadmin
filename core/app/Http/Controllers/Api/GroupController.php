<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('products')
            ->with([
                'groupProducts.product',
                'groupProducts.votes'
            ])
            ->latest()
            ->get();

        return response()->json($groups);
    }
    public function groupsByUser($telegramId)
    {
        $groups = Group::where('created_by_telegram_id', $telegramId)
            ->with([
                'groupProducts.product',
                'groupProducts.votes'
            ])
            ->withCount('groupProducts')
            ->latest()
            ->get();

        return response()->json($groups);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'created_by' => 'required|string'
        ]);

        $group = Group::create([
            'name' => $validated['name'],
            'created_by_telegram_id' => $validated['created_by'],
        ]);

        return response()->json($group);
    }
    public function show($id)
    {
        return Group::with([
            'groupProducts.product',
            'groupProducts.votes'
        ])->findOrFail($id);

        return response()->json($group);
    }
}

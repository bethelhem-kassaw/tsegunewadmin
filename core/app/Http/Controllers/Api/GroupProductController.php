<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupProduct;
use Illuminate\Http\Request;

class GroupProductController extends Controller
{
    public function store(Request $request, Group $group)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'added_by' => 'required|string'
        ]);

        $groupProduct = GroupProduct::create([
            'group_id' => $group->id,
            'product_id' => $validated['product_id'],
            'added_by_telegram_id' => $validated['added_by'],
        ]);

        return response()->json($groupProduct);
    }
    public function show($id)
    {
        $group = Group::with([
            'groupProducts.product',
            'groupProducts.votes'
        ])->findOrFail($id);

        return response()->json($group);
    }
}

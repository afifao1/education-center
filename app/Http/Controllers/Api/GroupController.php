<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json(Group::all());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $group = Group::create($request->all());
        return response()->json($group, 201);
    }

    public function show(Group $group)
    {
        return response()->json($group);
    }

    public function update(Request $request, Group $group)
    {
        $request->validate(['name' => 'required']);
        $group->update($request->all());
        return response()->json($group);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json(['message' => 'Group deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function saveGroup(Request $request) {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if(!$validated) {
            return response()->json([
                'message' => 'All fields are required'
            ], 400);
        } 

        $new_group = array(
            'name' => $request->name,
            'description' => $request->description,
        );

        $group = Group::create($new_group);

        if(!$group) {
            return response()->json([
                'message' => 'save error'], 400
            );
        } 
        
        return response()->json([
            'group' => $group,
            'message' => 'Successfully created group'], 200
        );
        
    }

    public function saveUserGroup(Request $request) {
        $validated = $request->validate([
            'group_id' => 'required',
        ]);

        if(!$validated) {
            return response()->json([
                'message' => 'All fields are required'
            ], 400);
        } 

        $userId  = User::findOrFail($request->user()->id);

        $grupoId = Group::findOrFail($request->group_id); 
        
        $member = DB::table('group_user')->where('group_id', $request->group_id)->where('user_id', $request->user()->id)->get();
 
        if(count($member) > 0) {
            return response()->json([
                'message' => 'Ya estas unido a este grupo'], 200
            );
        }

        $group_user = $userId->groups()->attach($grupoId); 
        
        return response()->json([
            'message' => 'Te has unido al grupo!'], 200
        );
    }

    public function getGroups() {
        return response()->json([
            'groups' => Group::all()
        ], 200);
    }

    public function getUserGroups($id_group) {
        $members = Group::where('id', $id_group)->with('users')->get()[0]->users;
        
        return response()->json([
            'members' => $members 
        ], 200);
    }

    public function deleteGroup(Request $request) {

        $group = Group::where('id', $request->id)->delete();

        if(!$group) {
            return response()->json([
                'message' => 'delete group error'], 400
            );
        } 

        return response()->json([
            'message' => 'Successfully deleted group'], 200
        );
    }
}
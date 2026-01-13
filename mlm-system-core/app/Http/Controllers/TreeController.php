<?php

namespace App\Http\Controllers;

use App\Models\MlmTree;
use App\Models\User;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    /**
     * Add a user to the MLM tree.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\MlmTree
     */
    public function addUser(User $user)
    {
        $parent = null;
        $level = 0;

        // If user has a referrer, find the referrer in the tree
        if ($user->referrer_id) {
            $referrerNode = MlmTree::where('user_id', $user->referrer_id)->first();
            
            if ($referrerNode) {
                $parent = $referrerNode->user; // The parent in the tree is the referrer (Direct Structure)
                $level = $referrerNode->level + 1;
            }
        }

        return MlmTree::create([
            'user_id' => $user->id,
            'parent_id' => $parent ? $parent->id : null,
            'level' => $level,
        ]);
    }
}

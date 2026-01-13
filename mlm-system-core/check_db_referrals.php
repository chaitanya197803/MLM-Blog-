<?php

use App\Models\User;
use App\Models\MlmTree;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Checking Database Entries for Referral Tracking ---\n\n";

$users = User::orderBy('created_at', 'desc')->take(10)->get();

echo "STAGING: Latest 10 Users\n";
echo str_pad("ID", 5) . str_pad("Name", 25) . str_pad("Ref Code", 15) . str_pad("Referrer ID", 15) . "\n";
echo str_repeat("-", 60) . "\n";

foreach ($users as $user) {
    echo str_pad($user->id, 5) . 
         str_pad(substr($user->name, 0, 23), 25) . 
         str_pad($user->referral_code ?? 'NULL', 15) . 
         str_pad($user->referrer_id ?? 'NULL', 15) . "\n";
}

echo "\n--- MLM Tree Node Consistency ---\n";
echo str_pad("User ID", 10) . str_pad("Tree Parent", 15) . str_pad("User Referrer", 15) . str_pad("Status", 10) . "\n";
echo str_repeat("-", 50) . "\n";

foreach ($users as $user) {
    $treeNode = MlmTree::where('user_id', $user->id)->first();
    $treeParentId = $treeNode ? $treeNode->parent_id : 'NO NODE';
    $userReferrerId = $user->referrer_id;
    
    $status = ($treeParentId == $userReferrerId || ($treeParentId === 'NO NODE' && $userReferrerId === null)) ? "MATCH" : "MISMATCH";
    
    if ($treeParentId === 'NO NODE' && $userReferrerId !== null) $status = "MISMATCH (No Node)";

    echo str_pad($user->id, 10) . 
         str_pad($treeParentId ?? 'NULL', 15) . 
         str_pad($userReferrerId ?? 'NULL', 15) . 
         str_pad($status, 10) . "\n";
}

echo "\n--- Summary ---\n";
$totalUsers = User::count();
$totalTreeNodes = MlmTree::count();
$usersWithReferrer = User::whereNotNull('referrer_id')->count();
$nodesWithParent = MlmTree::whereNotNull('parent_id')->count();

echo "Total Users: $totalUsers\n";
echo "Total Tree Nodes: $totalTreeNodes\n";
echo "Users with Referrer ID: $usersWithReferrer\n";
echo "Tree Nodes with Parent ID: $nodesWithParent\n";

if ($totalUsers != $totalTreeNodes) {
    echo "WARNING: Inconsistency detected! User count ($totalUsers) does not match Tree Node count ($totalTreeNodes).\n";
} else {
    echo "SUCCESS: User count matches Tree Node count.\n";
}

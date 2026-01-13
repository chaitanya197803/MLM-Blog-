<?php

use App\Models\User;
use App\Models\MlmTree;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email_suffix = Str::random(5);
$treeController = new TreeController();

function verifyNode($userId, $expectedParentId, $expectedLevel, $label) {
    $node = MlmTree::where('user_id', $userId)->first();
    if (!$node) {
        echo "[FAILURE] {$label}: Node not found in tree.\n";
        return false;
    }
    
    $passed = true;
    if ($node->parent_id != $expectedParentId) {
        echo "[FAILURE] {$label}: Parent ID mismatch. Expected: " . ($expectedParentId ?? 'NULL') . ", Got: " . ($node->parent_id ?? 'NULL') . "\n";
        $passed = false;
    }
    if ($node->level != $expectedLevel) {
        echo "[FAILURE] {$label}: Level mismatch. Expected: {$expectedLevel}, Got: {$node->level}\n";
        $passed = false;
    }
    
    if ($passed) {
        echo "[SUCCESS] {$label}: Verified (Level: {$node->level}, Parent ID: " . ($node->parent_id ?? 'NULL') . ")\n";
    }
    return $passed;
}

echo "--- 1. Chain Verification (Multi-Level) ---\n";

$u1 = User::create([
    'name' => 'U1 ' . $email_suffix,
    'email' => 'u1_' . $email_suffix . '@test.com',
    'password' => Hash::make('password')
]);
$treeController->addUser($u1);
verifyNode($u1->id, null, 0, "U1 (Root)");

$u2 = User::create([
    'name' => 'U2 ' . $email_suffix,
    'email' => 'u2_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u1->id
]);
$treeController->addUser($u2);
verifyNode($u2->id, $u1->id, 1, "U2 (Child of U1)");

$u3 = User::create([
    'name' => 'U3 ' . $email_suffix,
    'email' => 'u3_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u2->id
]);
$treeController->addUser($u3);
verifyNode($u3->id, $u2->id, 2, "U3 (Child of U2)");

$u4 = User::create([
    'name' => 'U4 ' . $email_suffix,
    'email' => 'u4_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u3->id
]);
$treeController->addUser($u4);
verifyNode($u4->id, $u3->id, 3, "U4 (Child of U3)");

echo "\n--- 2. Breadth Verification (Multi-Referral) ---\n";

$ua = User::create([
    'name' => 'UA ' . $email_suffix,
    'email' => 'ua_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u1->id
]);
$treeController->addUser($ua);
verifyNode($ua->id, $u1->id, 1, "UA (Child of U1)");

$ub = User::create([
    'name' => 'UB ' . $email_suffix,
    'email' => 'ub_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u1->id
]);
$treeController->addUser($ub);
verifyNode($ub->id, $u1->id, 1, "UB (Child of U1)");

$uc = User::create([
    'name' => 'UC ' . $email_suffix,
    'email' => 'uc_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $u1->id
]);
$treeController->addUser($uc);
verifyNode($uc->id, $u1->id, 1, "UC (Child of U1)");

echo "\nVerification Completed.\n";

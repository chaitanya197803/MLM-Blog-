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

// 1. Create Referrer
$referrer = User::create([
    'name' => 'Referrer ' . $email_suffix,
    'email' => 'referrer_' . $email_suffix . '@test.com',
    'password' => Hash::make('password')
]);

// 1.1 Add Referrer to Tree
$treeController = new TreeController();
$treeController->addUser($referrer);
$refNode = MlmTree::where('user_id', $referrer->id)->first();

echo "Referrer Created: {$referrer->name} (Level: {$refNode->level})\n";

// 2. Create Child
$child = User::create([
    'name' => 'Child ' . $email_suffix,
    'email' => 'child_' . $email_suffix . '@test.com',
    'password' => Hash::make('password'),
    'referrer_id' => $referrer->id,
    'referral_code' => User::generateReferralCode() // Ensure unique code
]);

// 2.1 Add Child to Tree
$treeController->addUser($child);
$childNode = MlmTree::where('user_id', $child->id)->first();

echo "Child Created: {$child->name} (Level: {$childNode->level}, Parent ID: {$childNode->parent_id})\n";

if ($childNode->parent_id == $referrer->id && $childNode->level == $refNode->level + 1) {
    echo "SUCCESS: Verification Passed.\n";
} else {
    echo "FAILURE: Verification Failed.\n";
}

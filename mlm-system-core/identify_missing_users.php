<?php

use App\Models\User;
use App\Models\MlmTree;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Identifying Users Missing from MLM Tree ---\n\n";

$usersMissingFromTree = User::whereNotExists(function ($query) {
    $query->select(DB::raw(1))
          ->from('mlm_tree')
          ->whereRaw('mlm_tree.user_id = users.id');
})->get();

if ($usersMissingFromTree->isEmpty()) {
    echo "No users are missing from the MLM tree.\n";
} else {
    echo "Found " . $usersMissingFromTree->count() . " users missing from the tree:\n";
    echo str_pad("ID", 5) . str_pad("Name", 25) . str_pad("Email", 30) . "\n";
    echo str_repeat("-", 60) . "\n";
    foreach ($usersMissingFromTree as $user) {
        echo str_pad($user->id, 5) . str_pad($user->name, 25) . str_pad($user->email, 30) . "\n";
    }
}

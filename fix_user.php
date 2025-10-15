<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Fixing superadmin user...\n\n";

$user = User::where('email', 'donijayapura23@123.com')->first();
if ($user) {
    echo "Found user: {$user->name}\n";
    echo "Current status: is_active = " . ($user->is_active ? 'true' : 'false') . "\n";
    
    // Activate user
    $user->is_active = true;
    
    // Set password to 'password'
    $user->password = Hash::make('password');
    
    $user->save();
    
    echo "✅ User updated:\n";
    echo "   - is_active = true\n";
    echo "   - password = 'password'\n\n";
    
    // Verify the changes
    $updatedUser = User::find($user->id);
    echo "Verification:\n";
    echo "- Active: " . ($updatedUser->is_active ? 'Yes' : 'No') . "\n";
    echo "- Password 'password' works: " . (Hash::check('password', $updatedUser->password) ? 'Yes' : 'No') . "\n";
    
} else {
    echo "❌ User not found!\n";
}

echo "\nCompleted.\n";
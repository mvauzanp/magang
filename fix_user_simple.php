<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Checking users table structure...\n";
$columns = Schema::getColumnListing('users');
echo "Users table columns: " . implode(', ', $columns) . "\n\n";

// Just update password, skip is_active
$user = User::where('email', 'donijayapura23@123.com')->first();
if ($user) {
    echo "Found user: {$user->name}\n";
    echo "Role: {$user->role}\n";
    
    // Set password to 'password'
    $user->password = Hash::make('password');
    $user->save();
    
    echo "✅ Password updated to 'password'\n\n";
    
    // Verify the changes
    $updatedUser = User::find($user->id);
    echo "Verification:\n";
    echo "- Password 'password' works: " . (Hash::check('password', $updatedUser->password) ? 'Yes' : 'No') . "\n";
    
} else {
    echo "❌ User not found!\n";
}

echo "\nCompleted.\n";
<?php

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

$user = User::where('email', 'donijayapura23@123.com')->first();
if ($user) {
    echo "User found:\n";
    echo "- Name: {$user->name}\n";
    echo "- Email: {$user->email}\n"; 
    echo "- Role: {$user->role}\n";
    echo "- Active: " . ($user->is_active ? 'Yes' : 'No') . "\n";
    echo "- Password Hash: " . substr($user->password, 0, 20) . "...\n";
    
    // Test password
    $testPassword = 'password';
    $passwordMatch = password_verify($testPassword, $user->password);
    echo "- Password 'password' matches: " . ($passwordMatch ? 'Yes' : 'No') . "\n";
    
    // Try different common passwords
    $commonPasswords = ['123456', 'admin', 'superadmin', 'donijayapura', '123123'];
    foreach ($commonPasswords as $pwd) {
        if (password_verify($pwd, $user->password)) {
            echo "- Password '{$pwd}' matches: Yes\n";
        }
    }
} else {
    echo "User not found!\n";
}
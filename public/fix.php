<?php
// File: public/fix.php
// Upload to: public/fix.php
// Visit: mahiratour.id/fix.php

echo "<h1>Mahira Tour - Emergency Fixer</h1>";

try {
    echo "1. Clearing Route Cache... ";
    echo shell_exec('cd .. && php artisan route:clear');
    echo " <span style='color:green'>Done</span><br>";

    echo "2. Clearing Config Cache... ";
    echo shell_exec('cd .. && php artisan config:clear');
    echo " <span style='color:green'>Done</span><br>";

    echo "3. Clearing View Cache... ";
    echo shell_exec('cd .. && php artisan view:clear');
    echo " <span style='color:green'>Done</span><br>";
    
    echo "<hr><h3>✅ SELESAI! Sekarang coba buka <a href='/test-email'>/test-email</a></h3>";

} catch (Exception $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}

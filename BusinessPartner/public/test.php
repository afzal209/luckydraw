<?php
echo shell_exec('composer dump-autoload');

exec('php artisan cache:clear');
exec('php artisan config:clear');
exec('php artisan route:clear');
exec('php artisan view:clear');
echo "Cache cleared!";
echo "Autoload dumped!";
?>

<?php

$providers = [
    App\Providers\AppServiceProvider::class,
];

if (class_exists('Filament\\PanelProvider') && class_exists('App\\Providers\\Filament\\AdminPanelProvider')) {
    $providers[] = App\Providers\Filament\AdminPanelProvider::class;
}

return $providers;

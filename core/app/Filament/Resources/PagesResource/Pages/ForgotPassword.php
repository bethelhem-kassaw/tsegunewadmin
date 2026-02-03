<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use Filament\Resources\Pages\Page;

class ForgotPassword extends Page
{
    protected static string $resource = PagesResource::class;

    protected static string $view = 'filament.resources.pages-resource.pages.forgot-password';
}

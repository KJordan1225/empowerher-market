<?php

namespace App\Filament\Resources\MyJobResource\Pages;

use App\Filament\Resources\MyJobResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyJob extends CreateRecord
{
    protected static string $resource = MyJobResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

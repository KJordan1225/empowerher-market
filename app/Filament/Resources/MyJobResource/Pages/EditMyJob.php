<?php

namespace App\Filament\Resources\MyJobResource\Pages;

use App\Filament\Resources\MyJobResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyJob extends EditRecord
{
    protected static string $resource = MyJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

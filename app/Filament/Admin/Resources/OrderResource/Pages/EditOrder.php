<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Action::make('Download Invoice')
                ->form([
                    TextInput::make('subject')->required(),
                    RichEditor::make('body')->required(),
                ])
                ->action(function (array $data) {
                    Mail::to($this->client)
                        ->send(new GenericEmail(
                            subject: $data['subject'],
                            body: $data['body'],
                        ));
                })
        ];
    }
}

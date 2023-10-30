<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Mail;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Actions\Action::make('sendEmail')
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
                }),

            Actions\Action::make('Download Invoice')
                ->action(function () {
                    dd($this->order);
                })
        ];
    }
}

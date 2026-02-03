<?php

namespace App\Filament\Resources\StakeholderResource\Pages;

use App\Filament\Resources\StakeholderResource;
use App\Notifications\RegisterResetpassword;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class CreateStakeholder extends CreateRecord
{
    protected static string $resource = StakeholderResource::class;

    protected function mutateFormDataBeforeCreate(array $data):array
    {
        $data['password'] = Hash::make('defaultpassword');
        // if(!array_key_exists('company_id',$data)){
        //     $data['company_id'] = auth()->user()->company_id;
        // }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Email has been sent to users email. In order to use the account user has to reset password there.';
    }
    protected function afterCreate(): void
    {

        //  $user = $this->record;
        // $token = app('auth.password')->broker('stakeholders')->createToken($user);
        // $notification = new RegisterResetpassword($token);
        // // $notification->url = \Filament\Facades\Filament::getResetPasswordUrl($token, $user);
        // $user->notify($notification);
        $email = $this->form->getState()['email'];
        Password::broker(config('filament-breezy.reset_broker', config('auth.defaults.passwords')))->sendResetLink(['email' => $email]);
    }
}

<x-mail::panel>
<x-mail::message>
# Hello
 
You are receiving this email because we received a password reset request for your account.

Your email verification code is <strong>{{ $optMessage }}</strong>

This password reset code will expire in 60 minutes.

If you did not request a password reset, no further action is required.
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
</x-mail::panel>
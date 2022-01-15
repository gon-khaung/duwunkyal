@component('mail::message')
If you didn't make any action about with password reset of your Duwunkyal account. You can ignore this email!

Please reset your account password by clicking the following link.
{{URL::to('/auth/new-password').'?token='.$token.'&userId='.$userId}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

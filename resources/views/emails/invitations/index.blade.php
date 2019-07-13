@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => $url, 'color' => 'success'])
Your invitation link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

<x-mail::message>
# Welcome to BorniesBlog!

Thanks for joining us. To get started and unlock all features of your account, we just need to verify your email address.

Click the button below to confirm this is your email address:

<x-mail::button :url="$url" color="primary">
Verify Email Address
</x-mail::button>

If you have trouble clicking the button, you can copy and paste the following URL into your web browser:
[{{ $url }}]({{ $url }})

If you did not create an account, no further action is required.

Best regards,<br>
**The {{ config('app.name') }} Team**
</x-mail::message>

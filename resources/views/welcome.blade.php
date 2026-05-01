@php
    use App\Models\Setting;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Setting::get('site_name', 'Site Name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Setting::get('site_favicon', asset('img/borniesLogo.webp')) }}">
    <meta name="description" content="{{ Setting::get('default_meta_description') }}">

    <meta name="keywords" content="{{ Setting::get('default_meta_keywords') }}">

</head>

<body>
    @foreach ($posts as $item)
        <h2>{{$item->title}}</h2>
        <h3>{{$item->user->name}}</h3>
    @endforeach
</body>

</html>
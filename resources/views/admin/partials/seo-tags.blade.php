@php
    use App\Models\Setting;
    $siteName = Setting::get('site_name', 'Site Name');
    $defaultDesc = Setting::get('default_meta_description', '');
    $defaultKeys = Setting::get('default_meta_keywords', '');

    // Fallbacks if $post is present
    $title = isset($post) ? ($post->meta_title ?: $post->title) : ($title ?? '');
    $description = isset($post) ? ($post->meta_description ?: $defaultDesc) : ($description ?? $defaultDesc);
    $keywords = isset($post) ? ($post->meta_keywords ?: $defaultKeys) : ($keywords ?? $defaultKeys);

    $fullTitle = $title ? "$title | $siteName" : $siteName;
@endphp

<title>{{ $fullTitle }}</title>
<link rel="icon" type="image/x-icon" href="{{ Setting::get('site_favicon', asset('img/borniesLogo.webp')) }}">
<meta name="description" content="{{ $description }}">

<meta name="keywords" content="{{ $keywords }}">

<!-- Open Graph -->
<meta property="og:title" content="{{ isset($post) && $post->og_title ? $post->og_title : $title }}">
<meta property="og:description"
    content="{{ isset($post) && $post->og_description ? $post->og_description : $description }}">
@if(isset($post) && $post->og_image)
    <meta property="og:image" content="{{ asset($post->og_image) }}">
@elseif(isset($post) && $post->image_path)
    <meta property="og:image" content="{{ asset($post->image_path) }}">
@endif
<meta property="og:type" content="{{ isset($post) ? 'article' : 'website' }}">
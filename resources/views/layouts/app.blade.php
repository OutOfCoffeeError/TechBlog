<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('inc.navbar')

        <main class="">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>
</body>
<script>
    // if(CKEDITOR.instances['element'])
    //       delete CKEDITOR.instances['element'];
    const ele = 'ckcontentbody';
    if(document.getElementById(ele)) {
        CKEDITOR.replace(ele, {
            extraPlugins : 'image2, imageresponsive, codesnippet, font',
            font_names: 'PT Serif; Georgia/Georgia, serif; Times New Roman/Times New Roman, Times, serif; Comic Sans MS/Comic Sans MS, cursive; Verdana/Verdana, Geneva, sans-serif; Arial/Arial, Helvetica, sans-serif',
	        codeSnippet_theme: 'ir_black',
            filebrowserImageBrowseUrl : '/ckeditor/pictures',
            filebrowserImageUploadUrl : '/ckeditor/pictures',
            removePlugins : 'image,easyimage, cloudservices'
        });
    }
</script>

</html>
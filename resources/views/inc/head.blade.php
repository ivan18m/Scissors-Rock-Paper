<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui"/>
    <meta name="description" content="">
    
    <title>{{ config('app.name') }}@yield('title')</title>
    
    <!-- CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" media="all">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" media="all">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" media="all">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all"/>
    
    <!-- Fonts -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,700' media="all">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
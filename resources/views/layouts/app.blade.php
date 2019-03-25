<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')
<body>
    <v-app v-cloak>
        @include('inc.toolbar')
        <v-content>
            @yield('content')
        </v-content>
    </v-app>
    @include('inc.scripts')
    @yield('script')
</body>
</html>

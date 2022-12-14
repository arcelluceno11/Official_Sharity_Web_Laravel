<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sharity - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('sharity_white.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('styles')

</head>

<body id="page-top">
    <div id="wrapper" style="height: 100vh;">
        @include('components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('components.footer')
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/theme.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="module">
        //Initialize Firebase
        import {
            initializeApp
        } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import {
            getDatabase,
            ref,
            onValue
        } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-database.js';
        import {
            setImage
        } from './js/firebasehelper.js';
        const firebaseConfig = {
            apiKey: "AIzaSyDrQnBzhOFfjrIqmOUabkt14wvx-LVnzug",
            authDomain: "sharity-f983e.firebaseapp.com",
            databaseURL: "https://sharity-f983e-default-rtdb.firebaseio.com",
            projectId: "sharity-f983e",
            storageBucket: "sharity-f983e.appspot.com",
            messagingSenderId: "599803730946",
            appId: "1:599803730946:web:e7ebe55992577653831b1b",
            measurementId: "G-2NTKV2NYYB"
        };
        const app = initializeApp(firebaseConfig);
        const database = getDatabase(app);


        const admins = ref(database, 'Admins/');
        onValue(admins, (snapshot) => {
            //Data
            const data = snapshot.val();

            var adminID = '{{ Session::get('adminID') }}';

            for (var key in data){
                if(data[key]['id'] == adminID){
                    $('#adminName').text(data[key]['name']);
                    setImage('Admin', data[key]['photo']);
                }
            }
        });
    </script>
    @yield('scripts')
</body>

</html>

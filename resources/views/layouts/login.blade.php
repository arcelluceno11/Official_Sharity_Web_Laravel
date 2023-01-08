<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.88.1" />
    <title>Sharity - Sign In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="text-center" style="background-color: #19B57D">
    <main class="form-signin">
        <form action="/login/signIn" method="POST">
            @csrf

            <img class="mb-4" src="{{ asset('sharity_white.png') }}" alt="" width="75" height="75" />
            <h1 class="h3 mb-3 fw-normal text-light">Sharity Admin</h1>

            @if ($errors->any())
                <div class="alert alert-warning" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" />
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" />
                <label for="floatingPassword">Password</label>
                <div style="margin: 8px">
                    <input type="checkbox" onclick="myFunction()"> <span style="font-size:15px; color: #f5f5f5">Show
                        Password</span>
                </div>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
            <p class="mt-5 mb-3 text-light">Copyright © Sharity 2022</p>
        </form>
    </main>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("floatingPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>

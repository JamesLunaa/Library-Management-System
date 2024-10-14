<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #not-available {
            display: none !important;
        }

        @media screen and (max-width: 1024px) {
            #main-content {
                display: none !important;
            }

            #not-available {
                display: block !important;
                text-align: center;
                font-size: 20px;
                margin-top: 50px;
            }

            body {
                background-color: maroon;
            }
        }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div id="not-available" class="card pb-4 border w-50 shadow-lg" style="max-width: 400px;">
            <h1>This website is currently not available on your device.</h1>
        </div>
        <div id="main-content" class="card pb-4 border w-50 shadow-lg" style="max-width: 400px;">
            <div class="card-header p-3 mb-4 text-center text-white">
                <h4>Library Login</h4>
            </div>
            <!-- Laravel form with CSRF token and updated action -->
            <form action="{{ route('login') }}" method="POST" class="px-4 pb-2">
                @csrf
                <div class="mb-3 text-center">
                    <img src="icons/stcLogo.png" alt="" width="130" height="100"
                        class="rounded-circle mb-3">
                </div>
                <div class="mb-3">
                    <label for="libraryId" class="form-label fw-bold">I.D Number</label>
                    <input type="text" name="libraryId" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-75">Sign In</button>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>

</html>

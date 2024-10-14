<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Password</title>
</head>

<body>

    <div class="mainCont d-flex text-white">

        @include('admin.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('admin.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center">
                        <h1>Change Pass</h1>
                    </div>
                    <div class="m-5">
                        <form action="{{ route('password.update') }}" method="post" class="fs-4"
                            id="registrationForm" onsubmit="return validatePasswords()">
                            @csrf
                            <div class="mb-3">
                                <label for="curPass" class="form-label">Current Password</label>
                                <input type="password" name="curPass" class="fs-5 form-control" required>
                                @error('curPass')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPass" class="form-label">New Password</label>
                                <input type="password" id="newPass" name="newPass" class="fs-5 form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="conPass" class="form-label">Confirm Password</label>
                                <input type="password" id="conPass" name="newPass_confirmation"
                                    class="fs-5 form-control" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Change</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        function validatePasswords() {
            var newPass = document.getElementById('newPass').value;
            var conPass = document.getElementById('conPass').value;

            if (newPass !== conPass) {
                alert("New Password and Confirm Password do not match.");
                // Reload the current page after the alert is dismissed
                location.reload();
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

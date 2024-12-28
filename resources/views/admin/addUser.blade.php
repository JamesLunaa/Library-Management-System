<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Register User</title>
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
                        <h1>Register a New User</h1>
                    </div>
                    <div class="m-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('admin.addUser.submit') }}" class="fs-4 row" id="registrationForm"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" name="name" class="fs-5 form-control"
                                    placeholder="Enter Name Here" required>
                                <div style="color: grey">Format: First name, middle name (if
                                    applicable), last name, and
                                    suffix (if applicable)</div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Library
                                    I.D</label>
                                <input type="number" name="libId" class="fs-5 form-control"
                                    placeholder="Enter ID Here" required>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">User Type</label>
                                <select name="accLevel" class="form-select fs-5" id="floatingSelect" aria-label="Floating label select example" required>
                                    <option value="user">Student</option>
                                    <option value="Instructor">Instructor</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <button type="submit" name="submit" class="btn btn-success btn-lg">Register</button>
                            </div>
                        </form>


                    </div>
                    <div>
                        <a href="{{ route('admin.removeUser') }}"><button type="submit"
                                class="btn btn-warning mt-3">User
                                List</button></a>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// session_start();
// include('../../control/admin/addBook.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Register Book</title>
    <script>
        function updateCharCount() {
            const textarea = document.getElementById('exampleFormControlTextarea1');
            const charCount = document.getElementById('charCount');
            const maxLength = textarea.maxLength;
            const currentLength = textarea.value.length;

            charCount.textContent = `${currentLength}/${maxLength}`;
        }
    </script>
</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('admin.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder border border-danger border-5" style="width: 200%;">

                @include('admin.layouts.header')

                <div class="card-body mainDisplay">

                    <div class="text-center">
                        <h1>Register a New Book</h1>
                    </div>
                    <div class="m-5">
                        <!-- Success message -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Error message (for validation or other errors) -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('addBook') }}" class="fs-4 pb-3" id="registrationForm" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" name="title" class="fs-5 form-control"
                                    placeholder="Enter Title Here" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Book Cover</label>
                                <input name="image" type="file" class="form-control" id="inputGroupFile02"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Accession
                                    Number</label>
                                <input type="number" name="accNo" class="fs-5 form-control"
                                    placeholder="Enter Acc No. Here" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Author</label>
                                <input type="text" name="author" class="fs-5 form-control"
                                    placeholder="Enter Author Name Here" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Synopsis</label>
                                <span id="charCount" class="form-text text-end text-secondary">0/5000</span>
                                <textarea class="shadow form-control textArea fs-5" name="synopsis" id="exampleFormControlTextarea1" maxlength="5000"
                                    oninput="updateCharCount()" rows="3" placeholder="Enter Synopsis Here" required></textarea>
                            </div>
                            <a href="">
                                <button type="submit" name="submit" class="btn btn-success btn-lg">Register</button>
                            </a>
                        </form>
                        <a href="{{ route('admin.removeBook') }}"><button class="btn btn-warning">Book
                                List</button></a>


                    </div>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

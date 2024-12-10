<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Status</title>

</head>

<body>
    <div id="no-scroll" class="mainCont d-flex text-white">

        @include('user.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('user.layouts.header')

                <div id="request-status" class="card-body mainDisplay border border-danger">
                    <div id="page-title" class="text-center mb-5">
                        <h1>Request Status</h1>
                    </div>
                    <div class="text-center">
                        <a id="remove-reload" href="{{ route('user.requestStatus') }}"><button type="submit"
                                class="btn btn-secondary fs-5">Reload</button></a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" id="error-alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <script>
                        // Hide success alert after 5 seconds
                        setTimeout(function() {
                            let successAlert = document.getElementById('success-alert');
                            if (successAlert) {
                                successAlert.style.display = 'none';
                            }
                        }, 4000); // 5000ms = 5 seconds

                        // Hide error alert after 5 seconds
                        setTimeout(function() {
                            let errorAlert = document.getElementById('error-alert');
                            if (errorAlert) {
                                errorAlert.style.display = 'none';
                            }
                        }, 4000); // 5000ms = 5 seconds
                    </script>



                    <section class="userList mt-4">
                        <div id="request-height" class="reqHeight">

                            <table class="table table-bordered table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                    @foreach ($myRequest as $request)
                                        @php
                                            // Determine the status color based on book_status
                                            if ($request->status == 'Pending') {
                                                $statusColor = 'color: yellow;';
                                                $disabled = '';
                                            } elseif ($request->status == 'Approved') {
                                                $statusColor = 'color: #00FA9A;';
                                                $disabled = 'disabled'; // Disable the button if status is Approved
                                            } else {
                                                $statusColor = 'color: gold;'; // Default color for any other status
                                                $disabled = '';
                                            }

                                        @endphp
                                        <tr>
                                            <td>{{ $request->date }}</td>
                                            <td>{{ $request->title }}</td>
                                            <td>{{ $request->accNo }}</td>
                                            <td style="{{ $statusColor }}">{{ $request->status }}</td>
                                            <td>
                                                <form action="{{ route('cancelUserRequest') }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to cancel the request?')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $request->id }}">
                                                    <button id="cancel-button" class="btn btn-danger" type="submit"
                                                        name="cancel" value="{{ $request->accNo }}"
                                                        {{ $disabled }}>
                                                        Cancel
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($myRequest->isEmpty())
                                <div class="text-center fs-4 text-danger"><strong>Empty!</strong></div>
                            @else
                            @endif

                        </div>
                    </section>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>

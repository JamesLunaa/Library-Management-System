<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Manage Books</title>

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
                        <h1>Book List</h1>
                    </div>
                    <div class="text-center mx-4">
                        <div class="d-flex gap-2">
                            <form action="{{ route('removeList') }}" class="flex-fill d-flex gap-2" method="POST">
                                @csrf
                                <div class="input-group input-group-lg mb-3">
                                    <input type="text" name="info" class="form-control shadow-sm"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                                        placeholder="Search...">
                                </div>
                                <div class="d-flex gap-2">
                                    <a href=""><button name="search" class="btn btn-primary text-white btn-lg"
                                            type="submit">Search</button></a>
                                </div>
                            </form>
                            <a href="{{ route('admin.removeBook') }}"><button type="submit"
                                    class="btn btn-secondary btn-lg">Reload</button></a>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.addBook') }}"><button type="submit"
                                class="btn btn-danger btn-lg">Return</button></a>
                    </div>

                    <section class="userList mt-3">
                        <div class="vh-auto recHeight">

                            <table class="table table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Acc No.</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($remove as $removeItem)
                                        <tr>
                                            <td>{{ $removeItem->title }}</td>
                                            <td>{{ $removeItem->accNo }}</td>
                                            <td>
                                                @if ($removeItem->status == 'Available')
                                                    <span style="color: #00FA9A;">Ready to be removed</span>
                                                    @php $disabled = ""; @endphp
                                                @else
                                                    <span style="color: #FA8072;">Borrowed</span>
                                                    @php $disabled = "disabled"; @endphp
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <form action="{{ route('removeBooks') }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this book?')">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit" name="lost"
                                                            value="{{ $removeItem->accNo }}" {{ $disabled }}>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($remove->isEmpty())
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
</body>

</html>

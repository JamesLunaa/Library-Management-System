<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Feedback</title>
    <script>
        // JavaScript function to update character count
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

        @include('user.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('user.layouts.header')

                <div class="card-body mainDisplay">
                    <div class="text-center mb-5">
                        <h1>Suggestions
                            / Feedbacks</h1>
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
                    <form action="{{ route('userFeedback') }}" class="text-center" method="post">
                        @csrf
                        <div class="mb-3">
                            <textarea class="shadow form-control textArea fs-5" name="suggFeed" id="exampleFormControlTextarea1" rows="3"
                                maxlength="255" oninput="updateCharCount()" placeholder="Suggestions or Feedbacks..." required></textarea>
                            <!-- Character Count Display -->
                            <div id="charCount" class="form-text text-end text-dark">0/255</div>
                        </div>
                        <button id="feedback-send" type="submit" name="send" class="btn btn-primary fs-5">Send</button>
                    </form>

                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>

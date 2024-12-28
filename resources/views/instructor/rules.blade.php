<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="/icons/stcLogo.png">
    <title>Rules</title>
    <style>
        
    </style>
    
</head>

<body>
    <div class="mainCont d-flex text-white">

        @include('instructor.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('instructor.layouts.header')

                <div class="card-body mainDisplay">
                    
                    <div class="border border-danger mt-2 mx-5 px-5 pt-3">
                        <strong><h2 class="text-center">Library Rules</h2></strong>
                        <ul>
                            <li>

                            </li>
                            <li>
                                
                            </li>
                            <li>
                                
                            </li>
                            <li>
                                
                            </li>
                            <li>
                                
                            </li>
                        </ul>
                    </div>

                        <div id="vmc" class="d-flex border border-danger flex-nowrap mt-5">
                            <div class="border border-danger p-2">
                                <strong><h1 class="text-center">v</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">Lorem ipsum dolor sit amet consectetur adipisicing 
                                    elit. Ex debitis molestiae quos ea nobis expedita 
                                    id deleniti dolores placeat, nostrum animi laborum 
                                    repudiandae earum amet ipsam asperiores ad tempora esse?</p>
                            </div>
                            <div class="border border-danger p-2">
                                <strong><h1 class="text-center">m</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                                    Rem quod minima voluptas aliquid, neque ullam placeat 
                                    magnam error quae molestias magni pariatur mollitia iure 
                                    debitis saepe praesentium excepturi. Ad, perferendis.</p>
                            </div>
                            <div class="border border-danger p-2">
                                <strong><h1 class="text-center">g</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                    Totam molestias natus nam nostrum cupiditate reiciendis. 
                                    Autem minima, nihil, error ducimus excepturi expedita 
                                    blanditiis nulla sit neque quos cumque eius eveniet!</p>
                            </div>
                        </div>

                        

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

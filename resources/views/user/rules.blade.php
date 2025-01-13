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

        @include('user.layouts.side')

        <!-- content here -->
        <div class="d-flex min-vh-100" style="width: 200%;">

            <div class="card min-vh-100 cardBorder" style="width: 200%;">

                @include('user.layouts.header')

                <div class="card-body mainDisplay">
                    
                    <div class="rulesWrap border border-danger p-3">

                        <div id="vmc" class="d-flex flex-nowrap mt-5 gap-3">
                            <div class="border border-black rounded-4 p-2">
                                <strong><h1 class="text-center" style="color: rgb(233, 28, 28);">VISION</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">
                                    The Saint Theresa College Library System Envisions to have sustaining academic
                                    resources to enhance library functions for easy access of information and research
                                    by faculty and student users through library automation.
                                </p>
                            </div>
                            <div class="border border-black rounded-4 p-2">
                                <strong><h1 class="text-center" style="color: rgb(233, 28, 28);">MISSION</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">
                                    As school's Library System, it endeavors to assist, serve and provide the school
                                    clientele all types of library services through its updated resources for adequate acquisition
                                    of knowledge and information especially in this highly technological world of the academe and research.
                                </p>
                            </div>
                            <div class="border border-black rounded-4 p-2">
                                <strong><h1 class="text-center" style="color: rgb(233, 28, 28);">GOAL</h1></strong>
                                <p class="fs-5" style="text-align: justify; text-indent: 3rem;">
                                    To fulfill its vision and mission, the school aims to uphold the integrity of the 
                                    Theresian community through its quality of instruction and learning with the value
                                    of providing library information thereby enhancing knowledge and expertise among
                                    its clientele.
                                </p>
                            </div>
                        </div>

                        <div class="border border-black rounded-4 mt-2 mx-5 px-5 pt-3">
                            <strong><h1 class="text-center" style="color: rgb(233, 28, 28);">OBJECTIVES</h1></strong>
                            <p class="fs-5" style="text-align: justify; text-indent: 3rem;">
                                The Saint Theresa College Library serves the informational needs of the students, faculty, staff,
                                and researchers of the college. It supports the curricular, research and extension service programs of
                                the college through the provision of properly maintained facilities.
                            </p>
                            <br>
                            <p class="fs-5" style="text-align: justify;">
                                The College Library is committed: <br>
                                <br>
                                To provide adequate, up-to-date and relevant resources, facilities and services to
                                the STC academic community as a means in achieving college goals and objectives;
                            </p>
                            <ul class="fs-5">
                                <li>
                                    To organize the collections of maximized and effective use;
                                </li>
                                <li>
                                    To develop, enrich and maintain the library collection in terms of the college and
                                    undergradiate curricular programs.
                                </li>
                            </ul>
                        </div>
    
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

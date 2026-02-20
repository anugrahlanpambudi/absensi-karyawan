<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Absensi Kantor</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            padding: 12px 20px;
            display: block;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background: #f1f1f1;
        }

        .content {
            padding: 25px;
        }

        .card-modern {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .navbar-clean {
            background: #ffffff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .sidebar .nav-link {
            transition: 0.2s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px;
            min-height: 100vh;
        }
    </style>
    

</head>
<link rel="stylesheet"
        href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<body>

    <div class="container-fluid">
        <div class="row">

            @include('components.sidebar')

            <div class="col-md-10 ms-sm-auto p-4"
                style="background:#f4f6f9; min-height:100vh;">

                @include('components.navbar')

                @yield('content')

            </div>

        </div>
    </div>

    @yield('scripts') <!-- optional untuk script page khusus -->

</body>



</html>
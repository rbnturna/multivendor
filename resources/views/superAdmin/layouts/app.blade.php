<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Additional Custom CSS -->
    @stack('styles') <!-- Allows for page-specific styles -->

</head>
<body>

    <!-- Main Container -->
    <div class="d-flex" id="wrapper">
        
        <!-- Sidebar -->
        @include('superAdmin.layouts.sidebar')

        <!-- Content Area -->
        <div id="page-content-wrapper" class="w-100">
            <!-- Navigation -->
            @include('superAdmin.layouts.navigation')

            <!-- Main Content -->
            <div class="container-fluid">
                @yield('content') <!-- Page-specific content will be injected here -->
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Custom JS -->
    @stack('scripts') <!-- Allows for page-specific scripts -->

</body>
</html>

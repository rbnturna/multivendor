<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layout.header')  <!-- Include the header -->
</head>
<body>
    @yield('content')  <!-- This will hold your main content -->
    
    @include('frontend.layout.footer')  <!-- Include the footer -->
</body>
</html>

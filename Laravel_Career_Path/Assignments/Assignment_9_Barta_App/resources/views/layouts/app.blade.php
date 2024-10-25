<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    @auth
        @include('partials.header')
    @endauth


    @yield('main-contents')

    @auth
        @include('partials.footer')
    @endauth
</body>


<script>
    //handles profile picture change preview in edit profile
    document.getElementById('avatar').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profile_picture_preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>


<script>
    //handles post image preview in create post (profile+index)
    document.getElementById('postimage').addEventListener('change', function(event) {
        const reader = new FileReader();

        reader.onload = function() {
            document.getElementById('post_image_preview').src = reader.result;
            document.getElementById('post_image_preview').style.display = 'block';

        };
        reader.readAsDataURL(event.target.files[0]);

    });
</script>

</html>

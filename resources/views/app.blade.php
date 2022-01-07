<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This website is for people who want to buy clothes.">
    <meta name="keywords" content="Duwunkyal, Duwun Kyal, duwunkyal, duwun kyal, north pole">

    <title>Duwun Kyal</title>

    <link rel="stylesheet" href="{{ asset('/build/css/app.css') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="/build/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="/build/assets/css/login.css" type="text/css">

    <script>
        window.baseUrl = "{{ url('/') }}";
    </script>
</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset('/build/js/app.js') }}"></script>
    <!-- Js Plugins -->
    <script src="/build/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/build/assets/js/jquery.nice-select.min.js"></script>
    <script src="/build/assets/js/jquery-ui.min.js"></script>
    <script src="/build/assets/js/jquery.slicknav.js"></script>
    <script src="/build/assets/js/mixitup.min.js"></script>
    <script src="/build/assets/js/owl.carousel.min.js"></script>
    <script src="/build/assets/js/main.js"></script>

    <script>
        // See https://github.com/tamino-martinius/ui-snippets-radiobuttons for Source Files build with webpack
// See https://github.com/tamino-martinius/ui-snippets-template for Snippet Template

const $inputs = document.getElementsByClassName('input');
for (let inputIndex = $inputs.length - 1; inputIndex >= 0; inputIndex--) {
  const $input = $inputs[inputIndex];
  // ...
}
const $radiobuttons = document.getElementsByClassName('input--radio');
for (let radioIndex = $radiobuttons.length - 1; radioIndex >= 0; radioIndex--) {
  const $radio = $radiobuttons[radioIndex];
  // ...
}
    </script>
</body>

</html>
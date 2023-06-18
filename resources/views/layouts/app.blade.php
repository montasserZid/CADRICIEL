<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
    <style>.pagination-arrow {
    width: 20px;
    height: 20px;
}</style>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false
        });
    </script>
    @endif

</head>

<body>
    @php $locale = session('locale') @endphp
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog.home') }}">College Maisonneuve</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('blog.home') }}">@lang('lang.home_text')</a></li>
                    @if (auth()->check())
                    <li class="nav-item"><a class="nav-link" href="">{{ __('lang.greeting') }} {{ $etudiant->nom }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">{{ __('lang.logout') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('forum.index') }}">forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('files.index') }}">@lang('lang.file')</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('lang.login') }}</a></li>
                    @endif


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">@lang('lang.lang')</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="nav-link @if($locale=='fr') bg-secondary text-dark @endif" href="{{ route('lang', 'fr') }}">French <i class="flag flag-france"></i></a>
                            </li>
                            <hr class="dropdown-divider" />
                            <li>
                                <a class="nav-link @if($locale=='en') bg-secondary text-dark @endif" href="{{ route('lang', 'en') }}">English <i class="flag flag-united-states"></i></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    @yield('content')
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Gi3c0M7oJsR25ff+UoG1HGDWE2fnv4zHCgWkYXJvMOzt83A0czIptpsNki6cbYPo" crossorigin="anonymous"></script>
    <!-- MDB core JS-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
</body>

</html>

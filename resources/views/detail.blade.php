<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Supraun Product</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/assets/medicine.png" />
        <!-- Bootstrap icons-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/main.css" rel="stylesheet" />
        <link href="/css/styles.css" rel="stylesheet" />
        <!--Bebas Font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand fw-bold" href="/">SupDoc</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ml-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('categories.index') }}">Category</a></li>
                        <!-- Authenticate Links -->
                        @guest
                        @if(Route::has('login'))
                            <li class="nav-item mt-1 mt-sm-2 mx-lg-1"><a href="/login" aria-current="page"><button type="button" class="btn btn-sm btn-danger">Login</button></a></li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                            <div class="dropdown-menu ml-lg-5" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#!">Halo, {{ Auth::user()->name }}</a>
                                <hr class="dropdown-divider" />
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                    <hr class="dropdown-divider" />
                                @endif
                                <a class="dropdown-item" href="{{ route('login') }}"  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    <form class="d-flex d-sm-inline-block form-inline mt-2 mt-sm-2 navbar-search" action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" name="search" id="search">
                            <div class="input-group-append">
                                <button class="btn btn-danger mx-1" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-flex d-sm-inline-block mt-2 mt-sm-2">
                    <a href="{{ route('cart.index') }}">
                        <button class="btn btn-info text-white position-relative">
                            <i class="fas fa-shopping-cart fa-sm"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $wishlists->count() }}
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Section-->
        <section class="py-5 vh-100">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->nama }}" height="400" width="500"/></div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">{{ $product->nama }}</h1>
                        <div class="fs-5 mb-5">
                            <span>Rp {{ number_format($product->harga,2) }}</span>
                            <br>
                            <span>Stok : {{ $product->stok }}</span>
                        </div>
                        <p class="lead">{{ $product->description }}</p>
                        {{-- <div class="d-flex">
                            <a href="http://wa.me/{{ $product->telfon }}" target="_blank">
                                <button class="btn btn-outline-danger flex-shrink-0" type="button">
                                    <i class="bi bi-whatsapp me-1"></i>
                                    Order Now
                                </button>
                            </a>
                        </div> --}}
                        <form action="{{ route('cart.addToWishlist') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->nama }}" name="nama">
                            <input type="hidden" value="{{ $product->category_id }}" name="category_id">
                            <input type="hidden" value="{{ $product->harga }}" name="harga">
                            <input type="hidden" value="{{ $product->image }}"  name="image">
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input type="hidden" value="1" name="quantity">
                            <button class="btn btn-outline-danger flex-shrink-0 show_confirm" type="submit">
                                <i class="bi bi-cart me-1 "></i>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Supraun Product 2021</p></div>
        </footer>

        <script type="text/javascript">

            $('.show_confirm').click(function(event) {
                    var form =  $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    swal({
                        title: `Product Berhasil Ditambahkan `,
                        text: "Product berhasil ditambahkan ke kerangjang.",
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                    });
                });
        </script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    </body>
</html>

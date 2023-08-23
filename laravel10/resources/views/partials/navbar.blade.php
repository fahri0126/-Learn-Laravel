<nav class="navbar navbar-expand-lg shadow-sm navbar-dark bg-success fixed-top">
    <div class="container">
      <!-- kiri -->
      <a class="navbar-brand fw-normal fs-4" href="/">fahri<span class="text-warning">Mart</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- kiri -->

      <!-- kanan -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav nav-pills me-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/produk">Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kategori">Kategori</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Products </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/produk">Products</a></li>
              <li><a class="dropdown-item" href="/kategori">Categories</a></li>
            </ul>
          </li> --}}
        </ul>

        <ul class="navbar-nav nav-pills ms-auto me-2">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link  text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-list fs-4"></i></a>
            <ul class="dropdown-menu">
              @if(auth()->user()->role_id == 2)
              <li><a class="dropdown-item text-info" href="/dashboard"><i class="bi bi-wrench-adjustable-circle"></i> Dashboard</a></li>
              @endif
              <li><a class="dropdown-item" href="/keranjang"><i class="bi bi-cart4"></i> Keranjang</a></li>
              <li><a class="dropdown-item" href="/transaksi"><i class="bi bi-wallet"></i> Transaksi</a></li>
              <li><hr class="dropdown-divider"></hr></li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-left"></i> Logout</button></form>
              </li>
            </ul>
          </li>

        @else
          @if($halaman == 'Login' | $halaman == 'Registration' )
          @else
          <li class="nav-item">
            <a class="nav-link text-center" href="/login"><i class="bi bi-box-arrow-in-right d-inline"></i> Login</a>
          </li>
          @endif
        @endauth
        </ul>
        
        @if ($halaman ===  'Home' || $halaman == 'Login' || $halaman == 'Registration' || $halaman == 'Dashboard')
        @else
         <form class="d-flex" action="" role="search">
            @if (request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <input class="form-control me-2 shadow-lg" type="text" name="pencarian" placeholder="Search" aria-label="Search" value="{{ request('pencarian') }}">
          <button class="btn btn-warning text-white" type="submit">Search</button>
          </form>
        @endif

      </div>
      <!-- kanan -->
    </div>
  </nav>
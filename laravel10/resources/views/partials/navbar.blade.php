<nav class="navbar navbar-expand-lg shadow-sm navbar-dark bg-success fixed-top">
    <div class="container">
      <!-- kiri -->
      <a class="navbar-brand fw-normal fs-4" href="#">fahri<span class="text-warning">Mart</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- kiri -->

      <!-- kanan -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Products </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/produk">Products</a></li>
              <li><a class="dropdown-item" href="/kategori">Categories</a></li>
              <li><a class="dropdown-item" href="#">other</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
          <form class="d-flex" action="/produk" role="search">
            @if (request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <input class="form-control me-2 shadow-lg" type="text" name="pencarian" placeholder="Search" aria-label="Search" value="{{ request('pencarian') }}">
            <button class="btn btn-warning text-white" type="submit">Search</button>
          </form>
      </div>
      <!-- kanan -->
    </div>
  </nav>
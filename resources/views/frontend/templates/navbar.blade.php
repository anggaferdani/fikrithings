<nav class="navbar navbar-expand-lg sticky-top shadow-sm" style="background: #fff491;">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('index') }}">Fikrithings</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ Route::is('index', 'articles', 'article') ? 'fw-bold' : '' }}" href="{{ route('index') }}">Index</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::is('about-me') ? 'fw-bold' : '' }}" href="{{ route('about-me') }}">About Me</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
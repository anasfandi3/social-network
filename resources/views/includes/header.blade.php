<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ route('dashboard') }}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('account') }}">Account</a>
        </li>  
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('logout') }}">Logout</a>
        </li>  
      </ul>
  </div>
</nav>
</header>
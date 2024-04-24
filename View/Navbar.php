<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/home">INNOKART</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active m-2" aria-current="page" href="/profile"> <?= $this->userData['fname'] ?> </a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" href="#">Link</a> -->
          <a class="nav-link" href="/cart">
            <img class="cart_icon" src="../Image/cart_icon.jpg">
          </a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input id="search-name" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <a href="/logout" type="button" class="btn btn-outline-danger m-2"> Log Out</a>
    </div>
  </div>
</nav>

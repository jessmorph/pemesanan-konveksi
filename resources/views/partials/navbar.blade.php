<nav class="navbar navbar-expand-lg d-flex justify-content-between align-items-center p-3 text-white bg-dark">
  <div>
    <label style="color: white; text-transform: uppercase;" for="name">WELCOME {{ Auth::user()->namaUser }}</label>
  </div>
  <div>
    <form action="/logout" method="post">
      @csrf
      <button class="btn btn-dark" type="submit">Logout</button>
    </form>
  </div>
</nav>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SMKN 12 Jakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      .left-column{
        background-image: url("{{ asset('assets/img/bg.jpg') }}");
        background-size: cover;
        background-position: center;
        min-height: 100vh;
      }
      /* Right column should take ~20% on large screens */
      .right-column{
        width: 20%;
        min-height: 100vh;
      }
      @media (max-width: 767.98px){
        .left-column{display:block; height:30vh; background-size:cover}
        .right-column{width:100%}
      }
    </style>
  </head>
  <body>

    <div class="container-fluid p-0">
      <div class="row g-0">

        <div class="col d-none d-sm-block left-column"></div>

        <div class="col-12 col-sm-auto right-column d-flex align-items-center justify-content-center bg-light">
          <div class="w-100 px-4 py-5" style="max-width:360px;">
            <div class="text-center mb-4 d-block d-sm-none">
              <!-- Small-screen image above form -->
              <img src="{{ asset('assets/img/bg.jpg') }}" alt="logo" height="64">
            </div>

            <div class="text-center mb-3">
              <img src="{{ asset('assets/img/image.png') }}" alt="logo" height="64" class="d-none d-sm-inline-block">
              <h4 class="mt-2">SMKN 12 Jakarta</h4>
              <p class="text-muted small">Silakan masuk menggunakan NIP dan password</p>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @method()
              @csrf

              <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input id="nip" name="nip" value="{{ old('nip') }}" type="text" class="form-control @error('nip') is-invalid @enderror" required autofocus>
                @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="temp/fonts/icomoon/style.css">
    <link rel="stylesheet" href="temp/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="temp/css/style.css">

    <title>Login</title>
  </head>
  <body>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <img src="temp/images/halamanlogin.png" alt="Image" class="img-fluid left-align" style="width: 500px; height: 500px; margin-top: -100px;">
          </div>
          <div class="col-md-6 contents">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="mb-4">
                  <h3>Sign In</h3>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group first">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                    </div>
                    <div class="form-group last mb-4">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="d-flex mb-5 align-items-center">
                      <label class="control control--checkbox mb-0">
                        <span class="caption">Remember me</span>
                        <input type="checkbox" checked="checked" name="remember_me">
                        <div class="control__indicator"></div>
                      </label>
                      <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                    </div>
                    <input type="submit" name="submit" class="btn btn-block btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="temp/js/jquery-3.3.1.min.js"></script>
    <script src="temp/js/popper.min.js"></script>
    <script src="temp/js/bootstrap.min.js"></script>
    <script src="temp/js/main.js"></script>
  </body>
</html>

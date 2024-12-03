<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="{{ asset('assets/loginStyle.css') }}" />
    <title>Login/Register</title>
  </head>

  <body>
    <div class="wrapper">
      <svg>
        <text x="50%" y="50%" dy=".35em" text-anchor="middle">Welcome</text>
      </svg>
    </div>

    <div class="container {{ request()->is('register') ? 'active' : '' }}" id="container">
      <div class="form-container sign-up">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <h1>Create Account</h1>
          <div class="social-icons">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <span>or use your email for registration</span>
          <input type="text" name="name" placeholder="Name" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
          <button type="submit">Register</button>
        </form>
      </div>
      <div class="form-container sign-in">
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <h1>Sign In</h1>
          <div class="social-icons">
            <i class="fa-solid fa-right-to-bracket"></i>
          </div>
          <span>or use your email password</span>
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <a href="#">Forget Your Password?</a>
          <button type="submit">Login</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Hello, There</h1>
            <p>Already have an account?</p>
            <button class="hidden" id="login">Sign In</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Hello, Friend!</h1>
            <p>Don't have an account?</p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/loginScript.js') }}"></script>
  </body>
</html>

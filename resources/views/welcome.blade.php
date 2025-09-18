<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - SIKAWAN</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body style="display:flex;align-items:center;justify-content:center;min-height:100vh;background:#f3f4f6">
  <div style="width:100%;max-width:980px;display:flex;gap:30px;align-items:stretch">
    <!-- left: branding -->
    <div style="flex:1;background:#4f6bf3;border-radius:12px;padding:30px;color:#fff;display:flex;flex-direction:column;justify-content:center">
      <h1 style="margin:0;font-size:28px">SIKAWAN</h1>
      <p style="opacity:0.95;margin-top:10px">Selamat datang. Silakan masuk untuk mengakses dashboard Superadmin.</p>
    </div>

    <!-- right: login form -->
    <div style="width:420px;background:#fff;border-radius:12px;padding:22px;box-shadow:0 6px 18px rgba(15,23,42,0.06)">
      <h2 style="margin:0 0 10px 0">Login</h2>

      @if($errors->any())
        <div style="background:#fee2e2;padding:10px;border-radius:8px;color:#991b1b;margin-bottom:10px">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('doLogin') }}" method="POST">
        @csrf
        <div style="margin-bottom:12px">
          <label style="display:block;margin-bottom:6px;font-size:13px">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required
            style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px">
        </div>

        <div style="margin-bottom:14px">
          <label style="display:block;margin-bottom:6px;font-size:13px">Password</label>
          <input type="password" name="password" required
            style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px">
        </div>

        <button type="submit" style="width:100%;padding:10px;background:#4f6bf3;color:#fff;border-radius:8px;border:none">Login</button>
      </form>
    </div>
  </div>
</body>
</html>

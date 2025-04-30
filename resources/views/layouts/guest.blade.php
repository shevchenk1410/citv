<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ URL::asset('/build/assets/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/build/assets/app.css') }}">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <style>
      .auth-bg-cover {
        background: rgb(34,42,60);
        background: linear-gradient(45deg, rgba(34,42,60,1) 0%, rgba(25,27,38,1) 100%);
      }
    </style>
</head>
<body>
  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-lg-2 p-4 auth-one-bg h-100">
                  <div class="position-relative h-100 d-flex flex-column align-items-lg-start align-items-center justify-content-center">
                    <img src="/build/images/logo-light.png" alt="logo" class="w-50">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-lg-2 p-4">
                    @yield('content')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<style type="text/css">
  .bg-grey{background-color: #4c4c4c; border-radius: 14px;}
  .logotipo{position: relative; top: 45%; left: 10%;}
  .form-control{outline: none; appearance: auto; border: 1px solid #afafaf !important;}
</style>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ __('J4 DENTAL Clinic') }}</title>
<!-- move all your current <link> CSS tags here too -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('J4 DENTAL Clinic') }}</title>

  <!-- Cache control -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <!-- Bootstrap 5 CSS (only one!) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Other CSS -->
<!-- icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('imges/bank.png') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

@if (!View::hasSection('hideNavBar'))
    @include('components.navbar')
@endif

<body>
    <div>

        <div id="home">@include('layouts.intro-banner')</div>
        <div id="welcome-to-j4-dc">@include('layouts.welcome-to-j4')</div>
        <div id="services">@include('layouts.services')</div>
        <div id="welcome-to-j4-dc">@include('layouts.consultation')</div>
        <div id="j4-story">@include('layouts.story')</div>
        <div id="j4-doctors">@include('layouts.doctors')</div>

        
        <div id="why-choose-j4dc">@include('layouts.why-choose-j4dc')</div>

    </div>

    @if (!View::hasSection('hideFooter'))
        <div class="footer" id="footer">
          @include('layouts.footer')
        </div>
    @endif



  <!-- Chat Toggle Button -->
<button id="chatToggle" class="chat-toggle">💬</button>

  <!-- Chatbox -->
  <div id="chatBox" class="chatbox" aria-hidden="true">
    <div class="chat-header">
      <div class="title">Chat Support</div>
      <button id="closeChat" class="close-chat" aria-label="Close chat">&times;</button>
    </div>

    <div id="chatMessages" class="chat-messages">
      <!-- initial greeting (optional) -->
      <div class="message-wrapper bot">
        <div class="avatar">🤖</div>
        <div class="message-bubble bot">Hello! 👋 How can I help you today?</div>
      </div>
    </div>

    <div class="chat-input">
      <input id="chatInput" type="text" placeholder="Type a message..." autocomplete="off" />
      <button id="sendBtn">Send</button>
    </div>
  </div>



</body>

@include('components.scripts')
</html>
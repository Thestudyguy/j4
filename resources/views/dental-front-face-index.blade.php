<!DOCTYPE html>
@include('components.layout-header')

<div class="preloader flex-column justify-content-center align-items-center">
    <div class="loaders">
        <div class="load-inner load-one"></div>
        <div class="load-inner load-two"></div>
        <div class="load-inner load-three"></div>
        <span class="text">Loading...</span>
    </div>
</div>

@if (!View::hasSection('hideNavBar'))
    @include('components.navbar')
@endif

<body>
    <div>

        <div id="home">@include('layouts.intro-banner')</div>
        <div id="welcome-to-j4-dc">@include('layouts.welcome-to-j4')</div>
        <div id="services">@include('layouts.services')</div>
        <div id="welcome-to-j4-dc">@include('layouts.consultation')</div>
        <!-- <div id="j4-story">@include('layouts.story')</div> -->
        <div id="j4-doctors">@include('layouts.doctors')</div>

        
        <div id="why-choose-j4dc">@include('layouts.why-choose-j4dc')</div>

    </div>

    @if (!View::hasSection('hideFooter'))
        @include('layouts.footer')
    @endif

<div class="chatbox" id="chatbox">
    <div class="chat-header">Chatbot</div>
    <div class="chat-messages" id="chatMessages"></div>
    <div class="chat-input">
      <input type="text" id="chatInput" placeholder="Type a message...">
      <button id="sendBtn">Send</button>
    </div>
  </div>

  <button class="chat-toggle" id="chatToggle">💬</button>

   <script>
    const chatToggle = document.getElementById("chatToggle");
    const chatbox = document.getElementById("chatbox");
    const sendBtn = document.getElementById("sendBtn");
    const chatInput = document.getElementById("chatInput");
    const chatMessages = document.getElementById("chatMessages");

    // Toggle chatbox
    chatToggle.addEventListener("click", () => {
      chatbox.style.display = chatbox.style.display === "flex" ? "none" : "flex";
    });

    // Send message
    sendBtn.addEventListener("click", sendMessage);
    chatInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {
      const msg = chatInput.value.trim();
      if (!msg) return;
      appendMessage("You", msg, "user");
      chatInput.value = "";
      setTimeout(() => {
        appendMessage("Bot", "This is a dummy response.", "bot");
      }, 600);
    }

    function appendMessage(sender, text, type) {
      const div = document.createElement("div");
      div.classList.add("message", type);
      div.innerText = `${sender}: ${text}`;
      chatMessages.appendChild(div);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  </script>
</body>

@include('components.scripts')

</html>
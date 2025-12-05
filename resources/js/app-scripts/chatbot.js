$(document).ready(function(){
$(function () {
    $('.qr-btn').on('click', function(){
      let text = $(this).data("text");
    appendMessage('user', text);
    $("#quickReplies").remove();
    sendMessage(text);
    });
      // ensure jQuery is loaded
      if (typeof $ === 'undefined') {
        console.error("jQuery not loaded.");
        return;
      }

      // Elements
      const $toggle = $("#chatToggle");
      const $box = $("#chatBox");
      const $close = $("#closeChat");
      const $messages = $("#chatMessages");
      const $input = $("#chatInput");
      const $send = $("#sendBtn");

      // Setup CSRF for Laravel AJAX
      const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': csrfToken }
      });

      // Debug helper
      function log(...args) { console.log("[chat] ", ...args); }

      // Toggle open (button -> box)
      $toggle.on("click", function () {
        log("toggle clicked (open)");
        $toggle.addClass("hidden");
        setTimeout(() => {
          $box.addClass("show").attr("aria-hidden", "false");
          // optional: focus input after open
          setTimeout(() => $input.focus(), 120);
        }, 180);
      });

      // Close (box -> button)
      $close.on("click", function () {
        log("close clicked");
        $box.removeClass("show").attr("aria-hidden", "true");
        setTimeout(() => {
          $toggle.removeClass("hidden");
        }, 260);
      });

      // Append message helper
      function appendMessage(type, text) {
        const wrapper = $('<div>').addClass('message-wrapper ' + (type === 'user' ? 'user' : 'bot'));
        const avatar = $('<div>').addClass('avatar').html(type === 'user' ? '👤' : '🤖');
        let bubble = $("<div>").addClass("message-bubble " + type).html(text);

        if (type === 'user') wrapper.append(bubble).append(avatar);
        else wrapper.append(avatar).append(bubble);

        $messages.append(wrapper);
        $messages.scrollTop($messages[0].scrollHeight);
      }

      // Sends and handles response
      function getBotResponse(userMsg, onDone) {
        log("sending AJAX to /chatbot/respond:", userMsg);

        $.ajax({
          url: "/chatbot/respond",    // <- make sure route exists in web.php
          method: "POST",
          data: { message: userMsg },
          timeout: 10000, // 10s
          success: function (res) {
            log("server reply:", res);
            if (res && res.reply) onDone(null, res.reply);
            else onDone(new Error("invalid server response"));
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX error:", textStatus, errorThrown, jqXHR);
            // try to show useful message
            const serverMessage = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : null;
            if (jqXHR.status === 419) {
              onDone(new Error("CSRF mismatch (419). Check meta CSRF token and that session is active."));
            } else if (serverMessage) {
              onDone(new Error(serverMessage));
            } else {
              onDone(new Error("Network/server error: " + textStatus));
            }
          }
        });
      }

      // typing indicator helper
      function createTyping() {
        const tw = $('<div>').addClass('message-wrapper bot typing-wrapper');
        const avatar = $('<div>').addClass('avatar').html('🤖');
        const bubble = $('<div>').addClass('message-bubble bot typing').text('Bot is typing...');
        tw.append(avatar).append(bubble);
        $messages.append(tw);
        $messages.scrollTop($messages[0].scrollHeight);
        return tw;
      }

      // Send handler
      function sendMessage(forcedText = null) {
    // Ignore if forcedText is not string
    if (forcedText && typeof forcedText !== 'string') forcedText = null;

    const msg = forcedText || $input.val().trim();
    if (!msg) return; // prevent empty messages

    if (!forcedText) {
        appendMessage('user', msg);
        $input.val('');
    }

    $input.prop('disabled', true);
    $send.prop('disabled', true);

    const typingEl = createTyping();

    getBotResponse(msg, function (err, reply) {
        typingEl.remove();
        $input.prop('disabled', false);
        $send.prop('disabled', false);
        $input.focus();

        if (err) {
            appendMessage('bot', "⚠️ " + (err.message || "Sorry, something went wrong."));
            return;
        }
        appendMessage('bot', reply);
    });
}


      // wire send button and enter key
     $send.on('click', e => { e.preventDefault(); sendMessage(); });

      // For dev: show console hint
      log("Chat UI ready. Ensure route POST /chatbot/respond exists.");
    });
  
});
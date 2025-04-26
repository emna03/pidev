document.getElementById("sendButton").addEventListener("click", sendMessage);
document.getElementById("userInput").addEventListener("keypress", function (e) {
  if (e.key === "Enter") sendMessage();
});

function sendMessage() {
  const userInput = document.getElementById("userInput");
  const query = userInput.value.trim();

  if (!query) return;

  // Add user message to chat
  const chatBox = document.getElementById("chatBox");
  chatBox.innerHTML += `
        <div class="message user-msg">
            <div class="content">${query}</div>
        </div>
    `;

  // Clear input
  userInput.value = "";
  userInput.focus();

  // Show loading indicator
  const loader = `
        <div class="message bot-msg">
            <div class="content">
                <i class="fas fa-spinner fa-spin"></i> Thinking...
            </div>
        </div>
    `;
  chatBox.insertAdjacentHTML("beforeend", loader);
  chatBox.scrollTop = chatBox.scrollHeight;

  // Send request to API
  fetch("/api/python/query", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: JSON.stringify({ query }),
  })
    .then((response) => response.json())
    .then((data) => {
      // Remove loader
      chatBox.lastChild.remove();

      // Add bot response
      chatBox.innerHTML += `
            <div class="message bot-msg">
                <div class="content">${
                  data.response || "No response received"
                }</div>
            </div>
        `;
      chatBox.scrollTop = chatBox.scrollHeight;
    })
    .catch((error) => {
      console.error("Error:", error);
      chatBox.lastChild.remove();
      chatBox.innerHTML += `
            <div class="message bot-msg">
                <div class="content">Error: Failed to get response</div>
            </div>
        `;
    });
}

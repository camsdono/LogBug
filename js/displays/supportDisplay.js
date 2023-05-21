function scrollToBottom() {
  var messagesContainer = document.querySelector('.messages-container');
  messagesContainer.scrollTop = messagesContainer.scrollHeight;

}

function addMessageToContainer(message, className) {
  const messagesContainer = document.querySelector(".messages-container");
  const messageDiv = document.createElement("div");
  messageDiv.classList.add("message", className);
  messageDiv.innerHTML = `<p>${message}</p>`;
  messagesContainer.appendChild(messageDiv);
  scrollToBottom();
}



addMessageToContainer("Hello, this is LogBug's Personal Support AI: Powered By Carter", "incoming");

function sendMessageToCarter(username) {
    var message = document.getElementById("message").value;
    if (message == "") {
      return;
    }
    const data = {
      text: message,
      key: "7eb6b757-5a9a-48e9-b4fd-6152abbc0938",
      playerId: username
    };
  
    const options = {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data)
    };
  
    fetch("https://api.carterlabs.ai/chat", options)
      .then(response => response.json())
      .then(data => addMessageToContainer(data.output.text, "incoming"))
      .catch(error => console.error(error));

    addMessageToContainer(message, "outgoing");

    document.getElementById("message").value = "";
}
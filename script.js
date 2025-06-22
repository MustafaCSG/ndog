const chatToggle = document.getElementById('chat-toggle');
const chatWidget = document.getElementById('chat-widget');
const chatForm = document.getElementById('chat-form');
const chatInput = document.getElementById('chat-input');
const chatBody = document.getElementById('chat-body');

let conversation = [];

chatToggle.addEventListener('click', () => {
  chatWidget.style.display = chatWidget.style.display === 'flex' ? 'none' : 'flex';
});

chatForm.addEventListener('submit', async function (e) {
  e.preventDefault();
  const userMessage = chatInput.value.trim();
  if (userMessage === '') return;

  addMessage(userMessage, 'user');
  chatInput.value = '';

  conversation.push({ role: "user", content: userMessage });

  const botReply = await getAIResponse(conversation);
  if (botReply) {
    addMessage(botReply, 'bot');
    conversation.push({ role: "assistant", content: botReply });
  }
});

function addMessage(text, sender) {
  const messageEl = document.createElement('div');
  messageEl.classList.add('message', sender);
  messageEl.textContent = text;
  chatBody.appendChild(messageEl);
  chatBody.scrollTop = chatBody.scrollHeight;
}

async function getAIResponse(messages) {
  try {
    const response = await fetch('https://api.openai.com/v1/chat/completions', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer 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'
      },
      body: JSON.stringify({
        model: 'gpt-3.5-turbo',
        messages: messages
      })
    });

    if (response.ok) {
      const data = await response.json();
      return data.choices[0].message.content.trim();
    } else {
      console.error("API response error:", await response.text());
      return "Üzgünüm, bir hata oluştu.";
    }
  } catch (error) {
    console.error("Fetch error:", error);
    return "Sunucuya bağlanılamadı.";
  }
}

document.addEventListener('DOMContentLoaded', function() {
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const chatbotMessages = document.getElementById('chatbot-messages');

    sendButton.addEventListener('click', function() {
        handleUserInput();
    });

    userInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            handleUserInput();
        }
    });

    function handleUserInput() {
        const message = userInput.value;
        addMessage(message, 'user');
        userInput.value = '';

        // Envoyer le message à Symfony pour obtenir une réponse du chatbot
        fetch('/chatbot/response', {
            method: 'POST',
            body: JSON.stringify({ message: message }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const chatbotResponse = data.response;
            addMessage(chatbotResponse, 'chatbot');
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
        messageDiv.textContent = text;
        chatbotMessages.appendChild(messageDiv);
    }
});
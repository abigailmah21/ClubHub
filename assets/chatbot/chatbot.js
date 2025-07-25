document.addEventListener('DOMContentLoaded', function() {
    const chatbotContainer = document.querySelector('.chatbot-container');
    const chatbotLauncher = document.querySelector('.chatbot-launcher');
    const messagesContainer = document.querySelector('.chatbot-messages');
    const messageInput = document.querySelector('.message-input');
    const sendBtn = document.querySelector('.send-btn');
    const minimizeBtn = document.querySelector('.minimize-btn');
    const closeBtn = document.querySelector('.close-btn');
    const header = document.querySelector('.chatbot-header');
    const suggestedQuestions = document.querySelectorAll('.suggested-question');

    // Activate chatbot after slight delay for better UX
    setTimeout(() => {
        chatbotContainer.classList.add('active');
    }, 300);

    // API Configuration
    const API_KEY = "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";
    const MODEL = "deepseek/deepseek-chat-v3-0324:free";
    const SITE_URL = window.location.href;
    const SITE_NAME = "ClubHub Assistant";

    // ClubHub FAQ Knowledge Base
    const CLUBHUB_FAQS = [
        {
            question: "join club|become member|sign up club",
            answer: "To join a club: 1) Browse the clubs directory 2) Click on a club you're interested in 3) Click the 'Join' button 4) Some clubs may require approval"
        },
        {
            question: "how many clubs can i join|club limit|maximum clubs",
            answer: "You can join as many clubs as you'd like! There's no limit to how many clubs you can be a member of."
        },
        {
            question: "sign up after carnival|join later|missed carnival",
            answer: "It depends on the club: some clubs take in new members all year, and some clubs have specific recruitment periods. We recommend approaching the club you're interested in to find out more about their membership policies."
        },
        {
            question: "how often carnival|when carnival|carnival schedule",
            answer: "The Club Carnival happens every major semester, usually 3 times a year during these periods: January-February, April-May, and August-September."
        },
        {
            question: "all clubs at carnival|missing clubs|complete list",
            answer: "No, due to venue capacity and the clubs' own preferences, some are not on display at the Carnival. You can find the complete list of clubs and societies at: Home Page > Clubs and Societies List"
        },
        {
            question: "contact club not at carnival|find club|club contact",
            answer: "The contact details of all clubs and societies can be found at: Home Page > Clubs and Societies List"
        },
        {
            question: "free to join|cost to join|membership fee",
            answer: "Please make enquiries to the respective club that you wish to join about any membership fees or costs."
        },
        {
            question: "start my own club|create new club|make club",
            answer: "Yes, you may refer to the Clubs & Societies Handbook for more information on the procedure to start a new club. <a class='faq-link' onclick='window.open(\"https://example.com/handbook\", \"_blank\")'>Clubs & Societies Handbook</a>"
        },
        {
            question: "sports club|sports question|athletic club",
            answer: "For sports clubs, you can find all contact links at: <a class='faq-link' onclick='window.open(\"https://cns-sunway.carrd.co/\", \"_blank\")'>https://cns-sunway.carrd.co/</a> or drop an email to sports@sunway.edu.my"
        },
        {
            question: "general question|extracurricular|activities",
            answer: "For general questions about clubs & societies and extracurricular activities, all contacts can be found on: <a class='faq-link' onclick='window.open(\"https://cns-sunway.carrd.co/\", \"_blank\")'>https://cns-sunway.carrd.co/</a> - Do check out the contacts listed there."
        },
        {
            question: "help carnival|navigate carnival|carnival guide",
            answer: "If you need help navigating the C&S Carnival, please visit the Info Booth at the entrance of the venue for guidance from our staff."
        }
    ];

    // Chat history with FAQ context
    let chatHistory = [
        {
            role: "system",
            content: `You are ClubHub's official assistant. Always follow these rules:
            1. PRIORITIZE the FAQ answers when relevant
            2. Keep responses concise and friendly
            3. For account-specific issues, direct users to support@clubhub.com
            4. Never make up features that don't exist
            5. For sports-related questions, direct to sports@sunway.edu.my
            6. For general inquiries, direct to the contacts at https://cns-sunway.carrd.co/
            
            Current ClubHub features:
            - Club joining and management
            - Club Carnival (3 times yearly)
            - Basic (free) membership`
        }
    ];

    // Add click handlers for suggested questions
    suggestedQuestions.forEach(question => {
        question.addEventListener('click', function() {
            messageInput.value = this.textContent;
            messageInput.focus();
        });
    });

    // Toggle chatbot visibility
    chatbotLauncher.addEventListener('click', function() {
        chatbotContainer.classList.add('active');
        chatbotLauncher.classList.add('active');
    });

    header.addEventListener('click', function(e) {
        if (e.target === header || e.target.classList.contains('chatbot-title')) {
            chatbotContainer.classList.toggle('minimized');
            const icon = minimizeBtn.querySelector('i');
            if (chatbotContainer.classList.contains('minimized')) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            } else {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }
    });

    closeBtn.addEventListener('click', function() {
        chatbotContainer.classList.remove('active');
        setTimeout(() => {
            chatbotLauncher.classList.remove('active');
        }, 300);
    });

    sendBtn.addEventListener('click', processMessage);
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') processMessage();
    });

    async function processMessage() {
        const messageText = messageInput.value.trim();
        if (messageText === '') return;

        addMessage(messageText, 'user');
        chatHistory.push({ role: "user", content: messageText });
        messageInput.value = '';

        // First check FAQs
        const faqResponse = checkFAQs(messageText);
        if (faqResponse) {
            addMessage(faqResponse, 'bot');
            chatHistory.push({ role: "assistant", content: faqResponse });
            return;
        }

        // If no FAQ match, call API
        showTypingIndicator();
        try {
            const response = await fetchOpenRouterAPI(messageText);
            addMessage(response, 'bot');
            chatHistory.push({ role: "assistant", content: response });
        } catch (error) {
            showError("Sorry, I'm having trouble connecting. Try again later.");
        }
    }

    function checkFAQs(question) {
        const lowerQuestion = question.toLowerCase();
        for (const faq of CLUBHUB_FAQS) {
            // Check both the question keywords and any aliases separated by |
            const keywords = faq.question.split('|');
            if (keywords.some(keyword => lowerQuestion.includes(keyword))) {
                return faq.answer;
            }
        }
        return null;
    }

    async function fetchOpenRouterAPI(message) {
        const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${API_KEY}`,
                "HTTP-Referer": SITE_URL,
                "X-Title": SITE_NAME,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "model": MODEL,
                "messages": chatHistory
            })
        });

        if (!response.ok) throw new Error(`API error: ${response.status}`);
        const data = await response.json();
        return data.choices[0].message.content;
    }

    function addMessage(text, sender) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', `${sender}-message`);
        
        const timeString = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        messageElement.innerHTML = `${text} <span class="message-time">${timeString}</span>`;
        
        messagesContainer.appendChild(messageElement);
        scrollToBottom();
    }

    function showTypingIndicator() {
        const typingElement = document.createElement('div');
        typingElement.classList.add('typing-indicator');
        typingElement.id = 'typing-indicator';
        typingElement.innerHTML = `
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        `;
        messagesContainer.appendChild(typingElement);
        scrollToBottom();
    }

    function removeTypingIndicator() {
        const typingElement = document.getElementById('typing-indicator');
        if (typingElement) typingElement.remove();
    }

    function showError(message) {
        removeTypingIndicator();
        const errorElement = document.createElement('div');
        errorElement.classList.add('error-message');
        errorElement.textContent = message;
        messagesContainer.appendChild(errorElement);
        scrollToBottom();
        setTimeout(() => errorElement.remove(), 5000);
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}); 
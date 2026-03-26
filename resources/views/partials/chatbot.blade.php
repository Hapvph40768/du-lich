<!-- Chatbot Partial -->
<div id="chatbot-container" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; font-family: 'Outfit', sans-serif;">
    <!-- Chat Icon -->
    <button id="chatbot-toggle" style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary-color); color: white; border: none; box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: transform 0.3s;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
    </button>

    <!-- Chat Window -->
    <div id="chatbot-window" style="display: none; position: absolute; bottom: 80px; right: 0; width: 350px; height: 500px; background: white; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.15); flex-direction: column; overflow: hidden; border: 1px solid rgba(0,0,0,0.05);">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, var(--primary-color) 0%, #ec4899 100%); padding: 1.25rem; color: white; display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%;"></div>
                <h3 style="margin: 0; font-size: 1.1rem; font-weight: 600;">Hỗ Trợ Khách Hàng</h3>
            </div>
            <button id="chatbot-close" style="background: none; border: none; color: white; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chatbot-messages" style="flex: 1; padding: 1.5rem; overflow-y: auto; background: #f9fafb; display: flex; flex-direction: column; gap: 1rem;">
            <!-- Initial AI Message -->
            <div style="align-self: flex-start; max-width: 80%;">
                <div style="background: white; border: 1px solid #e5e7eb; padding: 1rem; border-radius: 15px; border-bottom-left-radius: 0; color: #374151; font-size: 0.95rem; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                    Chào bạn! 👋 Chào mừng đến với Đặt Tour NHANH. Lựa chọn một chủ đề để tôi có thể hỗ trợ bạn nhé.
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-start; margin-top: 0.5rem;" id="options-container">
                <button class="topic-btn" data-topic="Sự cố đặt Tour">Sự cố đặt Tour</button>
                <button class="topic-btn" data-topic="Câu hỏi thanh toán">Câu hỏi thanh toán</button>
                <button class="topic-btn" data-topic="Thông tin Tour">Thông tin Tour</button>
            </div>
        </div>

        <!-- Input Area -->
        <div style="padding: 1rem; background: white; border-top: 1px solid #e5e7eb;">
            <form id="chatbot-form" style="display: flex; gap: 10px;">
                @csrf
                <input type="text" id="chat-input" disabled placeholder="Chọn một chủ đề..." style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 20px; outline: none; transition: border-color 0.2s;">
                <button type="submit" id="chat-submit" disabled style="background: var(--primary-color); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; opacity: 0.5;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .topic-btn {
        background: white; border: 1px solid var(--primary-color); color: var(--primary-color);
        padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 500; cursor: pointer;
        transition: all 0.2s;
    }
    .topic-btn:hover { background: var(--primary-color); color: white; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('chatbot-toggle');
        const closeBtn = document.getElementById('chatbot-close');
        const windowDiv = document.getElementById('chatbot-window');
        const messagesDiv = document.getElementById('chatbot-messages');
        const topicBtns = document.querySelectorAll('.topic-btn');
        const chatInput = document.getElementById('chat-input');
        const chatSubmit = document.getElementById('chat-submit');
        const chatForm = document.getElementById('chatbot-form');
        
        let activeTicketId = null;

        toggleBtn.addEventListener('click', () => {
            windowDiv.style.display = windowDiv.style.display === 'none' ? 'flex' : 'none';
            toggleBtn.style.transform = windowDiv.style.display === 'flex' ? 'scale(0)' : 'scale(1)';
        });

        closeBtn.addEventListener('click', () => {
            windowDiv.style.display = 'none';
            toggleBtn.style.transform = 'scale(1)';
        });

        // Handle topic selection
        topicBtns.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const topic = e.target.getAttribute('data-topic');
                
                // Add user message visually
                addMessage(topic, 'user');
                document.getElementById('options-container').style.display = 'none';

                // Add loading indicator
                const loadingId = addMessage('Đang xử lý...', 'ai', true);

                try {
                    const response = await fetch('/chatbot/init', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({ subject: topic })
                    });
                    
                    const data = await response.json();
                    
                    // Remove loading
                    document.getElementById(loadingId).remove();

                    if(data.success) {
                        activeTicketId = data.ticket_id;
                        addMessage(data.message.replace(/Great.*detail\./, 'Tuyệt vời. Tôi đã tạo phiếu hỗ trợ cho chủ đề này. Vui lòng mô tả chi tiết vấn đề của bạn.'), 'ai');
                        chatInput.disabled = false;
                        chatSubmit.disabled = false;
                        chatSubmit.style.opacity = '1';
                        chatInput.placeholder = "Nhập tin nhắn...";
                        chatInput.focus();
                    } else {
                        addMessage("Vui lòng đăng nhập để sử dụng tính năng Chat.", 'ai');
                        setTimeout(() => window.location.href = '/login', 2000);
                    }
                } catch (error) {
                    document.getElementById(loadingId).remove();
                    addMessage("Đã xảy ra lỗi. Vui lòng thử lại sau.", 'ai');
                }
            });
        });

        // Handle chat submit
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = chatInput.value.trim();
            if(!message || !activeTicketId) return;

            addMessage(message, 'user');
            chatInput.value = '';
            
            const loadingId = addMessage('...', 'ai', true);

            try {
                const response = await fetch('/chatbot/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ ticket_id: activeTicketId, message: message })
                });

                const data = await response.json();
                document.getElementById(loadingId).remove();

                if(data.success) {
                    addMessage(data.reply.replace(/Thank you.*shortly\./, 'Cảm ơn thông tin của bạn. Đội ngũ chúng tôi sẽ phản hồi trong giây lát.'), 'ai');
                }
            } catch (error) {
                document.getElementById(loadingId).remove();
                addMessage("Không thể gửi tin nhắn.", 'ai');
            }
        });

        function addMessage(text, sender, isLoading = false) {
            const id = 'msg-' + Date.now();
            const align = sender === 'user' ? 'align-self: flex-end;' : 'align-self: flex-start;';
            const bg = sender === 'user' ? 'background: var(--primary-color); color: white;' : 'background: white; border: 1px solid #e5e7eb; color: #374151;';
            const radius = sender === 'user' ? 'border-radius: 15px; border-bottom-right-radius: 0;' : 'border-radius: 15px; border-bottom-left-radius: 0;';
            
            messagesDiv.innerHTML += `
                <div id="${id}" style="${align} max-width: 80%; opacity: 0; transform: translateY(10px); transition: all 0.3s;">
                    <div style="${bg} padding: 0.75rem 1rem; ${radius} font-size: 0.95rem; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                        ${text}
                    </div>
                </div>
            `;
            
            // Animation
            setTimeout(() => {
                const el = document.getElementById(id);
                if(el) {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }
            }, 50);

            messagesDiv.scrollTop = messagesDiv.scrollHeight;
            return id;
        }
    });
</script>

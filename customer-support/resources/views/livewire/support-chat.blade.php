<div>
    <div class="messages">
        @foreach($messages as $message)
            <div class="message {{ $message->user_id == 0 ? 'bot' : 'user' }}">
                <p>{{ $message->content }}</p>
                <span>{{ $message->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage">
        <input type="text" wire:model="newMessage">
        <button type="submit">Send</button>
    </form>
</div>

<style>
    .message.user {
        background-color: #f1f1f1;
    }
    .message.bot {
        background-color: #e1e1ff;
    }
</style>

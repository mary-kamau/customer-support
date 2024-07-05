// app/Http/Livewire/SupportChat.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;

class SupportChat extends Component
{
    public $messages;
    public $newMessage;

    protected $rules = [
        'newMessage' => 'required|max:255',
    ];

    public function mount()
    {
        $this->messages = Message::latest()->get();
    }

    public function sendMessage(GeminiService $geminiService)
    {
        $this->validate();

        $message = Message::create([
            'content' => $this->newMessage,
        ]);

        $this->messages->prepend($message);
        $this->newMessage = '';

        $response = $geminiService->sendQuery($message->content);

        $responseMessage = Message::create([
            'content' => $response['answer'],
        ]);

        $this->messages->prepend($responseMessage);

        $this->emit('messageSent', $responseMessage->id);
    }

    public function render()
    {
        return view('livewire.support-chat');
    }
}

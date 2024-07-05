namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

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

        // Store user message
        $message = Message::create([
            'user_id' => Auth::id(),
            'content' => $this->newMessage,
        ]);

        $this->messages->prepend($message);
        $this->newMessage = '';

        // Send query to Gemini API
        $response = $geminiService->sendQuery($message->content);

        // Store Gemini API response
        $responseMessage = Message::create([
            'user_id' => 0, // Assuming 0 is the ID for the bot/admin
            'content' => $response['answer'],
        ]);

        $this->messages->prepend($responseMessage);

        $this->emit('messageSent', $responseMessage->id);

        // Dispatch the MessageSent event
        event(new MessageSent($message));
    }

    public function render()
    {
        return view('livewire.support-chat');
    }

    protected $listeners = ['messageSent' => 'refreshMessages'];

    public function refreshMessages()
    {
        $this->messages = Message::latest()->get();
    }
}

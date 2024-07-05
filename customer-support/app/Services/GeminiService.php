namespace App\Services;

use GuzzleHttp\Client;

class GeminiService
{
    protected $client;
    protected $apiKey;
    //protected $apiSecret;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.gemini.api_key');
        // $this->apiSecret = config('services.gemini.api_secret');
    }

    public function sendQuery($query)
    {
        $response = $this->client->post('https://api.gemini.com/v1/query', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'query' => $query,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}

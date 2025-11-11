namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppWebhookController extends Controller
{
    // Stap 1: verificatie door Meta
    public function verify(Request $request)
    {
			$verifyToken = "9qEtOSeKeAlkeDx5qO9O"; // kies zelf iets unieks

        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');
		
        if ($mode === 'subscribe' && $token === $verifyToken) {
            return response($challenge, 200);
        }

        return response('Invalid token', 403);
    }

    // Stap 2: inkomende berichten ontvangen
    public function receive(Request $request)
    {
        $data = $request->all();
        Log::info('WhatsApp bericht ontvangen:', $data);

        // Voorbeeld: berichttekst ophalen
        if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
            $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
            $from = $message['from']; // telefoonnummer
            $text = $message['text']['body'] ?? '';

            // Hier kun je opslaan in de database
            // Booking::create([...]);
        }

        return response()->json(['status' => 'ok']);
    }
}

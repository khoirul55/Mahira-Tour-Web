<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $baseUrl = 'https://api.fonnte.com';
    protected $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    /**
     * Send WhatsApp Message via Fonnte
     *
     * @param string $target Phone number (08xxx or 62xxx)
     * @param string $message Message content
     * @return array|bool Response data or false on failure
     */
    public function sendMessage($target, $message)
    {
        // 1. Check if Token exists
        if (!$this->token) {
            Log::warning('Fonnte Token is not set in configuration.');
            return false;
        }

        try {
            // 2. Send Request
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->baseUrl . '/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default Indonesia
            ]);

            // 3. Log Result
            if ($response->successful()) {
                Log::info('WhatsApp sent to ' . $target);
                return $response->json();
            } else {
                Log::error('WhatsApp failed to ' . $target . ': ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp Exception: ' . $e->getMessage());
            return false;
        }
    }
}
FONN
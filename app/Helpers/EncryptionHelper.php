<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class EncryptionHelper
{
    private static function getKey(): string
    {
        return hash('sha256', config('app.http_key'), true); // Generate 32-byte key
    }

    public static function encrypt(string $text): array
    {
        $key = self::getKey();
        $iv = random_bytes(16); // Generate a random IV

        $encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        return [
            'data' => base64_encode($encrypted),
            'iv' => bin2hex($iv), // Convert IV to hex for transmission
        ];
    }

    public static function decrypt(string $encryptedData, string $iv): ?string
    {
        try {
            $key = self::getKey();
            $decodedIv = hex2bin($iv);
            $decrypted = openssl_decrypt(base64_decode($encryptedData), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $decodedIv);

            return $decrypted ?: null;
        } catch (Exception $e) {
            Log::error('Decryption failed: ' . $e->getMessage());
            return null;
        }
    }
}

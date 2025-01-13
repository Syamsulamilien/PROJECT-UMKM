<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $originCity;

    public function __construct()
    {
        $this->apiKey = config('rajaongkir.api_key');
        $this->baseUrl = config('rajaongkir.base_url');
        $this->originCity = config('rajaongkir.origin_city');
    }

    public function getProvinces()
{
    try {
        Log::info('Attempting to get provinces');
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/province');

        Log::info('RajaOngkir Response: ' . $response->body());

        return $response->json()['rajaongkir']['results'] ?? [];
    } catch (\Exception $e) {
        Log::error('RajaOngkir Error: ' . $e->getMessage());
        throw $e;
    }
}
    public function getCities($provinceId = null)
    {
        try {
            $params = $provinceId ? ['province' => $provinceId] : [];
            
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . '/city', $params);

            Log::info('RajaOngkir City URL: ' . $this->baseUrl . '/city');
            Log::info('RajaOngkir City Params: ' . json_encode($params));
            Log::info('RajaOngkir Cities Response: ' . json_encode($response->json()));

            return $response->json()['rajaongkir']['results'] ?? [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir City Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function calculateShipping($destination, $weight, $courier)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->post($this->baseUrl . '/cost', [
                'origin' => $this->originCity,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            Log::info('RajaOngkir Cost URL: ' . $this->baseUrl . '/cost');
            Log::info('RajaOngkir Cost Request: ' . json_encode([
                'origin' => $this->originCity,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]));
            Log::info('RajaOngkir Cost Response: ' . json_encode($response->json()));

            return $response->json()['rajaongkir']['results'][0]['costs'] ?? [];
        } catch (\Exception $e) {
            Log::error('RajaOngkir Cost Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\User;

class RecommendationService
{
    /**
     * Главный метод
     */
    public function getRecommendations(User $user, int $limit = 10)
    {
        $profileVector = $this->buildUserProfile($user);

        return $this->findSimilarAds($profileVector, $user, $limit);
    }

    /**
     * Профиль пользователя (вектор интересов)
     */
    private function buildUserProfile(User $user): array
    {
        $views = AdView::where('user_id', $user->id)->pluck('ad_id');
        $favorites = $user->favorites()->pluck('ads.id');
        $chats = $user->chats ?? collect();

        $weightedAds = [];

        // VIEW = 1
        foreach ($views as $adId) {
            $weightedAds[$adId] = ($weightedAds[$adId] ?? 0) + 1;
        }

        // FAVORITE = 3
        foreach ($favorites as $adId) {
            $weightedAds[$adId] = ($weightedAds[$adId] ?? 0) + 3;
        }

        // CHAT = 5
        foreach ($chats as $chat) {
            if ($chat->last_ad_id) {
                $weightedAds[$chat->last_ad_id] =
                    ($weightedAds[$chat->last_ad_id] ?? 0) + 5;
            }
        }

        if (empty($weightedAds)) {
            return [];
        }

        $ads = Ad::whereIn('id', array_keys($weightedAds))->get();

        $totalWeight = array_sum($weightedAds);

        // диапазоны для нормализации
        $minPrice = Ad::min('price');
        $maxPrice = Ad::max('price');

        $minMileage = Ad::min('mileage');
        $maxMileage = Ad::max('mileage');

        $minYear = Ad::min('year');
        $maxYear = Ad::max('year');

        $minPower = Ad::min('engine_power');
        $maxPower = Ad::max('engine_power');

        $minVolume = Ad::min('engine_volume');
        $maxVolume = Ad::max('engine_volume');

        $vector = [
            'price' => 0,
            'mileage' => 0,
            'year' => 0,
            'engine_power' => 0,
            'engine_volume' => 0,
            'brand_id' => [],
        ];

        foreach ($ads as $ad) {
            $w = $weightedAds[$ad->id];

            $vector['price'] += $this->normalize($ad->price, $minPrice, $maxPrice) * $w;
            $vector['mileage'] += $this->normalize($ad->mileage, $minMileage, $maxMileage) * $w;
            $vector['year'] += $this->normalize($ad->year, $minYear, $maxYear) * $w;
            $vector['engine_power'] += $this->normalize($ad->engine_power, $minPower, $maxPower) * $w;
            $vector['engine_volume'] += $this->normalize($ad->engine_volume, $minVolume, $maxVolume) * $w;

            // бренд как голосование
            $vector['brand_id'][$ad->brand_id] =
                ($vector['brand_id'][$ad->brand_id] ?? 0) + $w;
        }

        return [
            'price' => $vector['price'] / $totalWeight,
            'mileage' => $vector['mileage'] / $totalWeight,
            'year' => $vector['year'] / $totalWeight,
            'engine_power' => $vector['engine_power'] / $totalWeight,
            'engine_volume' => $vector['engine_volume'] / $totalWeight,
            'brand_id' => array_search(max($vector['brand_id']), $vector['brand_id']),
        ];
    }

    /**
     * Поиск похожих объявлений
     */
    private function findSimilarAds(array $profile, User $user, int $limit)
    {
        if (empty($profile)) {
            return Ad::latest()->limit($limit)->get();
        }

        $ads = Ad::where('user_id', '!=', $user->id)->get();

        $results = [];

        foreach ($ads as $ad) {
            $vector = $this->calculateAdVector($ad);

            $score = $this->cosineSimilarity($profile, $vector);

            $results[] = [
                'ad' => $ad,
                'score' => $score,
            ];
        }

        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        return collect($results)
            ->take($limit)
            ->pluck('ad');
    }

    /**
     * Вектор объявления
     */
    private function calculateAdVector(Ad $ad): array
    {
        $minPrice = Ad::min('price');
        $maxPrice = Ad::max('price');

        $minMileage = Ad::min('mileage');
        $maxMileage = Ad::max('mileage');

        $minYear = Ad::min('year');
        $maxYear = Ad::max('year');

        $minPower = Ad::min('engine_power');
        $maxPower = Ad::min('engine_power');

        $minVolume = Ad::min('engine_volume');
        $maxVolume = Ad::min('engine_volume');

        return [
            'price' => $this->normalize($ad->price, $minPrice, $maxPrice),
            'mileage' => $this->normalize($ad->mileage, $minMileage, $maxMileage),
            'year' => $this->normalize($ad->year, $minYear, $maxYear),
            'engine_power' => $this->normalize($ad->engine_power, $minPower, $maxPower),
            'engine_volume' => $this->normalize($ad->engine_volume, $minVolume, $maxVolume),
            'brand_id' => $ad->brand_id,
        ];
    }

    /**
     * Косинусное сходство
     */
    private function cosineSimilarity(array $a, array $b): float
    {
        $dot = 0;
        $normA = 0;
        $normB = 0;

        foreach ($a as $key => $value) {
            $dot += $value * ($b[$key] ?? 0);
            $normA += $value ** 2;
        }

        foreach ($b as $value) {
            $normB += $value ** 2;
        }

        if ($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dot / (sqrt($normA) * sqrt($normB));
    }
}
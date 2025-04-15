<?php

namespace App\Notifications;

use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class SymbolHasRecommendations extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Recommendation $recommendation)
    {
        $this->recommendation->loadMissing(['symbol.market.country', 'symbol.sector', 'symbol.quote']);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $locale = $notifiable->language ?? app()->getLocale();
        $isArabic = $locale === 'ar';

        $viewData = $this->prepareViewData($notifiable, $isArabic);
        $subject = "{$viewData['stockSymbol']} : {$viewData['title']}";

        return (new MailMessage)
            ->subject($subject);
    }

    /**
     * Prepare the data array to be passed to the Markdown view.
     *
     * @param object $notifiable The object being notified (likely User)
     * @param bool $isArabic Flag indicating if Arabic locale should be used
     * @return array<string, mixed>
     */
    protected function prepareViewData(object $notifiable, bool $isArabic): array
    {
        $locale = $notifiable->language ?? app()->getLocale();

        $symbol = $this->recommendation->symbol;
        $market = $symbol?->market;
        $country = $market?->country;
        $sector = $symbol?->sector; // Assuming relationship exists
        $quote = $symbol?->quote; // Assuming relationship exists

        // --- Safely access related data with null checks ---
        $companyName = $isArabic && $symbol?->name_ar ? $symbol->name_ar : $symbol?->name_en;
        $marketName = $isArabic && $country?->name_ar ? $country->name_ar : $country?->name_en;
        $sectorName = $isArabic && $sector?->name_ar ? $sector->name_ar : $sector?->name_en; // Sector name
        $subGroup = $market ? ($companyName . ' / ' . $market->code) : $companyName; // Construct subgroup
        $recommendationTitle = $isArabic && $this->recommendation->title_ar ? $this->recommendation->title_ar : $this->recommendation->title;
        $description = $isArabic && $this->recommendation->description_ar ? $this->recommendation->description_ar : $this->recommendation->description;
        $points = $isArabic && !empty($this->recommendation->points_ar) ? $this->recommendation->points_ar : $this->recommendation->points;

        // --- Determine Icon URL (Example logic - adjust as needed) ---
        $groupIcon = 'https://objects.kira.ws/logos/groups/default.png'; // Default icon
        if ($sectorName && str_contains(strtolower($sectorName), 'energy')) {
            $groupIcon = 'https://objects.kira.ws/logos/groups/energy.png';
        } elseif ($sectorName && str_contains(strtolower($sectorName), 'bank')) {
            $groupIcon = 'https://objects.kira.ws/logos/groups/bank.png'; // Assuming you have a bank icon
        } // Add more else if conditions for other sectors


        return [
            'userName' => $notifiable->name ?? 'User',
            'recipientEmail' => $notifiable->email,
            'locale' => $locale,


            // Recommendation & Symbol Details
            'stockSymbol' => $symbol?->symbol ?? 'N/A',
            'marketCode' => $market?->code ?? 'N/A',
            'companyName' => $companyName ?? 'N/A',
            'marketName' => $marketName ?? 'N/A',
            'title' => $recommendationTitle ?? 'New Recommendation', // Use specific title
            'description' => $description ?? 'A new recommendation is available for you.',
            'points' => $points ?? [],
            'riskLevel' => Str::title($this->recommendation->risk_level ?? 'N/A') . ' risk', // Format risk level

            // Card Specific Data
            'recommendationGroup' => $sectorName ?? 'General', // Use sector name
            'recommendationSubGroup' => $subGroup ?? 'Details',
            'groupIconUrl' => $groupIcon, // Pass the icon URL
            'currency' => $symbol?->currency ?? 'USD', // Safely access currency
            'currentPrice' => $quote?->last_price ?? $this->recommendation->current_price ?? 0, // Use quote price if available
            'priceChange' => $quote?->change ?? 0, // Get change from quote
            'priceChangePercentage' => $quote?->change_percentage ?? 0, // Get change % from quote

            // URLs and Config
            'appUrl' => url("https://kira.ws/recommendations/{$this->recommendation->slug}"),
            'helpUrl' => url('https://kira.ws/contact'),
            'logoUrl' => 'https://objects.kira.ws/logos/kira-dark.png',
            'footerLogoUrl' => 'https://objects.kira.ws/logos/kira-dark-full.png',
            'socialXUrl' => 'https://objects.kira.ws/logos/social/x.png',
            'socialFacebookUrl' => 'https://objects.kira.ws/logos/social/facebook.png',
            'socialInstagramUrl' => 'https://objects.kira.ws/logos/social/instagram.png',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $locale = $notifiable->locale ?? app()->getLocale();
        $isArabic = $locale === 'ar';

        // Select title and short description based on locale
        $title = $isArabic && !empty($this->recommendation->title_ar)
            ? $this->recommendation->title_ar
            : $this->recommendation->title;

        // Use short_description if available, otherwise fallback to description
        $description = $isArabic && !empty($this->recommendation->short_description_ar)
            ? $this->recommendation->short_description_ar
            : ($isArabic && !empty($this->recommendation->description_ar)
                ? $this->recommendation->description_ar
                : (!empty($this->recommendation->short_description)
                    ? $this->recommendation->short_description
                    : $this->recommendation->description));

        // You might want to truncate the description for a notification feed
        $shortDescription = Str::limit($description ?? '', 100); // Limit to 100 chars

        return [
            'recommendation_id' => $this->recommendation->id,
            'title' => $title ?? 'New Recommendation', // Localized title
            'message' => $shortDescription, // Localized short description/message
            'symbol' => $this->recommendation->symbol?->symbol ?? 'N/A',
            'icon' => 'pi pi-megaphone', // Example icon for UI
            'url' => url("https://kira.ws/recommendations/{$this->recommendation->slug}"), // Link to the full recommendation
            'type' => 'recommendation', // Type identifier for frontend handling
        ];
    }
}

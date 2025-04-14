{{-- Determine text direction based on locale --}}
@php
    $direction = ($locale ?? app()->getLocale()) === 'ar' ? 'rtl' : 'ltr';
@endphp

@component('mail::message', ['direction' => $direction]) {{-- Pass direction to the component --}}

{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        <img src="{{ $logoUrl ?? 'https://objects.kira.ws/logos/kira-dark.png' }}" class="logo" alt="{{ config('app.name') }} Logo" style="max-width: 80px;">
    @endcomponent
@endslot

{{-- Body --}}
<h1 dir="{{ $direction }}">{{ __('Recommendation Related to') }} {{ $stockSymbol }} - {{ $marketCode }}</h1>

<p dir="{{ $direction }}">
    {{ __('Hey there!') }} {{ __('We\'ve got a fresh recommendation for') }} **{{ $companyName }} ({{ $stockSymbol }})** {{ __('in') }} {{ $marketName }}. {{ __("After checking out some recent activity, we put together this just for you!") }}
</p>

{{-- Recommendation Card Start --}}
<table class="recommendation-card" width="100%" cellpadding="0" cellspacing="0" role="presentation" dir="{{ $direction }}" style="border: 1px solid #E4E4E7; border-radius: 8px; padding: 20px; margin-bottom: 25px; background-color: #f8fafc; text-align: {{ $direction === 'rtl' ? 'right' : 'left' }};">
    <tr>
        <td>
            {{-- Card Header Table --}}
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" class="header" style="margin-bottom: 15px; padding: 0; background: none; border: none;">
                <tr>
                    {{-- Title Section (Left in LTR, Right in RTL) --}}
                    <td style="vertical-align: middle; text-align: {{ $direction === 'rtl' ? 'right' : 'left' }}; padding-{{ $direction === 'rtl' ? 'left' : 'right' }}: 10px;">
                        <table cellpadding="0" cellspacing="0" role="presentation" class="title-section">
                            <tr>
                                {{-- Conditionally place icon based on direction --}}
                                @if($direction === 'ltr')
                                    <td style="padding-right: 10px; vertical-align: middle;">
                                        <img src="{{ $groupIconUrl ?? 'https://objects.kira.ws/logos/groups/default.png' }}" alt="Icon" class="icon" width="32" height="32" style="width: 32px; height: 32px;">
                                    </td>
                                @endif
                                <td style="vertical-align: middle;">
                                    <p class="title" style="font-weight: 600; color: #1F1F1F; font-size: 16px; margin: 0;">{{ $recommendationGroup }}</p>
                                    <p class="subtitle" style="font-size: 14px; color: #71717a; margin: 0;">{{ $recommendationSubGroup }}</p>
                                </td>
                                @if($direction === 'rtl')
                                    <td style="padding-left: 10px; vertical-align: middle;">
                                        <img src="{{ $groupIconUrl ?? 'https://objects.kira.ws/logos/groups/default.png' }}" alt="Icon" class="icon" width="32" height="32" style="width: 32px; height: 32px;">
                                    </td>
                                @endif
                            </tr>
                        </table>
                    </td>
                    {{-- Price Section (Right in LTR, Left in RTL) --}}
                    <td style="vertical-align: middle; text-align: {{ $direction === 'rtl' ? 'left' : 'right' }};" class="price-section">
                        <p class="price" style="font-weight: 600; color: #1F1F1F; font-size: 16px; margin: 0;">{{ $currency }} {{ number_format($currentPrice, 2) }}</p>
                        <p class="change" style="font-size: 14px; margin: 0; color: {{ $priceChange >= 0 ? '#16a34a' : '#ef4444' }};">
                            {{ $priceChange >= 0 ? '+' : '' }}{{ number_format($priceChangePercentage, 2) }}%
                        </p>
                    </td>
                </tr>
            </table>
            {{-- Card Details --}}
            <div class="details" style="font-size: 14px; color: #3f3f46;">
                <p style="margin-bottom: 5px;">{{ $description }}</p> {{-- Already localized in Notification --}}
                @if(!empty($points) && is_array($points))
                    <ul style="list-style: disc; margin-{{ $direction === 'rtl' ? 'right' : 'left' }}: 20px; padding-{{ $direction === 'rtl' ? 'right' : 'left' }}: 0; margin-top: 10px; margin-bottom: 15px;">
                        @foreach($points as $point)
                            <li style="margin-bottom: 5px;">{{ $point }}</li> {{-- Already localized in Notification --}}
                        @endforeach
                    </ul>
                @endif
                <p class="risk" style="font-size: 14px; color: #71717a; font-style: italic; margin-top: 15px;">{{ $riskLevel }}</p> {{-- Already localized in Notification --}}
            </div>
        </td>
    </tr>
</table>
{{-- Recommendation Card End --}}

{{-- Action Button --}}
@component('mail::button', ['url' => $appUrl, 'color' => 'primary'])
    {{ __('Open in app') }}
@endcomponent

{{-- Questions Section --}}
<div class="questions" dir="{{ $direction }}" style="text-align: center; padding: 20px; background-color: #f8fafc; margin-top: 30px; font-size: 14px; color: #5E5E5E;">
    {{ __('Questions?') }} <a href="{{ $helpUrl ?? '#' }}" style="color: #1F1F1F; font-weight: 600; text-decoration: underline;">{{ __('We are here to help') }}</a>
</div>


{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        <p class="email-info" dir="{{ $direction }}" style="margin-bottom: 15px; font-size: 12px; color: #5E5E5E;">{{ __('This email was sent to') }} {{ $recipientEmail }}</p>
        <img src="{{ $footerLogoUrl ?? 'https://objects.kira.ws/logos/kira-dark-full.png' }}" alt="{{ config('app.name') }} Logo" class="footer-logo" style="max-width: 100px; margin-bottom: 15px;">
        <div class="social-icons" style="margin-bottom: 15px;">
            <a href="#" style="margin: 0 8px; display: inline-block;"><img src="{{ $socialXUrl ?? 'https://objects.kira.ws/logos/social/x.png' }}" alt="X" width="20" height="20" style="width: 20px; height: 20px;"></a>
            <a href="#" style="margin: 0 8px; display: inline-block;"><img src="{{ $socialFacebookUrl ?? 'https://objects.kira.ws/logos/social/facebook.png' }}" alt="Facebook" width="20" height="20" style="width: 20px; height: 20px;"></a>
            <a href="#" style="margin: 0 8px; display: inline-block;"><img src="{{ $socialInstagramUrl ?? 'https://objects.kira.ws/logos/social/instagram.png' }}" alt="Instagram" width="20" height="20" style="width: 20px; height: 20px;"></a>
        </div>
        © {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
    @endcomponent
@endslot
@endcomponent

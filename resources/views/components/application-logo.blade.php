@if(isset($settings['site_logo']) && file_exists(public_path($settings['site_logo'])))
    <img src="{{ asset($settings['site_logo']) }}" {{ $attributes->merge(['class' => 'object-contain']) }} alt="Logo">
@else
<svg viewBox="0 0 24 24" fill="none" {{ $attributes }} xmlns="http://www.w3.org/2000/svg">
    <!-- Outer glow / soft aura -->
    <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" fill="url(#flowerGlow)" opacity="0.15"/>
    <!-- Left petal -->
    <path d="M12 6C9 8.5 7.5 11.5 8 14.5C8.5 17.5 11 19 12 19C12 19 12 6 12 6Z" fill="url(#petalGradientLeft)"/>
    <!-- Right petal -->
    <path d="M12 6C15 8.5 16.5 11.5 16 14.5C15.5 17.5 13 19 12 19C12 19 12 6 12 6Z" fill="url(#petalGradientRight)"/>
    <!-- Center bud (tulip / rose bud) -->
    <path d="M12 5.5C10.5 8 10 11 11 13.5C12 16 12.5 17.5 12 17.5C11.5 17.5 12 16 13 13.5C14 11 13.5 8 12 5.5Z" fill="#ffb3b8"/>
    <!-- Heart-shaped leaf detail at base -->
    <path d="M12 18.5C11.5 18 10.5 17.5 10 18.2C9.5 18.9 10.2 19.8 11.2 20C11.8 20.1 12 20.5 12 20.5C12 20.5 12.2 20.1 12.8 20C13.8 19.8 14.5 18.9 14 18.2C13.5 17.5 12.5 18 12 18.5Z" fill="#fb7185"/>

    <defs>
        <radialGradient id="flowerGlow" cx="12" cy="12" r="9" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#fda4af" />
            <stop offset="100%" stop-color="#fff5f6" stop-opacity="0" />
        </radialGradient>
        <linearGradient id="petalGradientLeft" x1="8" y1="6" x2="12" y2="19" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#ff808b"/>
            <stop offset="100%" stop-color="#f43f5e"/>
        </linearGradient>
        <linearGradient id="petalGradientRight" x1="16" y1="6" x2="12" y2="19" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#fda4af"/>
            <stop offset="100%" stop-color="#e11d48"/>
        </linearGradient>
    </defs>
</svg>
@endif

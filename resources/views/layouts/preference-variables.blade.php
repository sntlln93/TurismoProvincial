<style>
    :root {
        --first-color       : #FC9536;
        --first-color-alt   : rgba(212, 113, 19, 0.3);
        --second-color      : white;
        --third-color       : black;
        --fourth-color      : gray;
        --nav-color-web     : {!! $district->preferences->primary_color !!}; 
        --body-color        : #F0F0F0;
        --login-color       : rgb(63, 63, 63);
        --footer-color      : {!! $district->preferences->secondary_color !!};
        --border-color      : rgba(53, 53, 53, 0.2);
        --hover-color       : #ffa44f;
        
        /* Website */
        --font-family           : "{!! $district->preferences->font_family !!}";
        --first-color-web       : {!! $district->preferences->primary_color !!}; 
        --title-color           : #363636;
        --border-gradient       : linear-gradient(62deg, #fbab7e 0%, #f7ce68 100%);
        --footer-color-web      : {!! $district->preferences->secondary_color !!};
    }
</style>

<link rel="shortcut icon" href="{{ ! Str::contains($district->preferences->logo, 'no-image') ? $district->preferences->logo : asset('img/Logo1-LR.png') }}" />

@if(session()->has('above-navbar-message') && auth()->check())
    <div style="color: black">
        {!! session()->get('above-navbar-message') !!}
    </div>
@endif
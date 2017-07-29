@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
    <div>
        <div>
            <p>{{ session()->get('message') }}</p>
        </div>
    </div>
    @else
    <div>
        <div>
            <p>{{ session()->get('message') }}</p>
        </div>
    </div>
    @endif
@endif
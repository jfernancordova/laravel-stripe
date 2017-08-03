<!-- Errors -->
@if (count($errors) > 0)
    <div style="text-align: center" class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your information<br><br>

        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
        @endforeach

    </div>
    <br>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@else
    <h4>{{$errors->first()}}</h4>
@endif
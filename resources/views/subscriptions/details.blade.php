@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Subscription Panel
                    </div>
                    <div class="panel-body">
                        @include('partials.messages')
                        <div class="bs-example" data-example-id="thumbnails-with-custom-content">
                            <div class="row">
                                @if ($user->subscription('main')->onGracePeriod())
                                    <div class="alert alert-danger text-center">
                                        Subscription Canceled. <br>
                                        If you didn't cancel your subscription, send us an email!</br>
                                        You have access to Laravel - Stripe Premium  until {{Auth::user()->subscription('main')->ends_at->format('F d, Y') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div style="margin-top: 20px" class="col-sm-6">
                                        <div class="panel-heading">
                                            <div class="well text-center">
                                                <strong>Current Plan:</strong> {{ ucfirst($user->subscription('main')->stripe_plan) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <center><h4>Update Subscription</h4></center>
                                        <div style="text-align: center">
                                            <form action="{{route('updateSub')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label class="panel-heading">
                                                        <select name="plan" class="form-control">
                                                            <option value="basic" {{($user->onPlan('basic')) ? 'selected' : ''}}> Basic</option>
                                                            <option value="monthly" {{($user->onPlan('monthly')) ? 'selected' : ''}}>Monthly</option>
                                                            <option value="yearly" {{ ($user->onPlan('yearly')) ? 'selected' : ''}}>Yearly</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $user->subscription('main')->onGracePeriod() ? 'Resubscribe' : 'Update Plan' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-header">
                                    <center><h4>Update Card</h4></center>
                                    <div style="text-align: center">
                                        <form action="{{route('updateCard')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <script
                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                    data-key="{{env('STRIPE_KEY')}}"
                                                    data-description="Update Card Details"
                                                    data-panel-label="Update Card Details"
                                                    data-label="Update Card Details"
                                                    data-allow-remember-me=false
                                                    data-locale="auto">
                                            </script>
                                        </form>
                                    </div>
                                </div>
                                <div class="section-header">
                                    <div class="panel-heading">
                                        <h4>Billing History</h4>
                                    </div>
                                </div>
                                @if (count($invoices) > 0)
                                    <div class="panel-heading">
                                        <table class="table table-bordered table-striped table-hover">
                                            @foreach ($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                                    <td>{{ $invoice->total() }}</td>
                                                    <td class="col-xs-2">
                                                        <a href="/user/account/invoices/{{ $invoice->id }}" class="btn btn-primary btn-sm">Download</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @else
                                    <div class="jumbotron text-center">
                                        <p>No billing history.</p>
                                    </div>
                                @endif
                                <form action="{{route('suspendSub')}}" method="POST" class="text-right">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-link">
                                        Cancel Subscription
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

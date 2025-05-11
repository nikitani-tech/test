@extends('app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h2 class="fw-bold">Thank You for Your Order!</h2>
                        <p class="lead text-muted mt-3 mb-4">
                            Your order has been successfully placed. We’ll send you a confirmation email shortly.
                        </p>

                        <div class="mb-4">
                            <h5 class="mb-2">Order Summary</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Order Number:</span> <strong>#{{ $order_id }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total:</span><strong>₴{{ $order_total }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Payment Method:</span> <strong>{{ $payment_method }}</strong>
                                </li>
                            </ul>
                        </div>

                        <a href="/" class="btn btn-primary btn-lg mt-3">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



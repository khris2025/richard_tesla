@extends('Userview.layouts.app')

@section('content')
    @error('message')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: @json($message),
            });
        </script>
    @enderror

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
            });
        </script>
    @endif

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Car Purchase Checkout</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                                    <li class="breadcrumb-item active">Car Purchase Checkout</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h2 class="card-title">Order Summary</h2>
                            </div>
                            <div class="card-body pb-0 text-center">
                                <img id="blah" src="{{ asset('storage/' . $car->car_img) }}" alt="Uploaded Image" class="img-fluid" style="max-width: 100%; max-height: 250px; object-fit: cover;">
                                <br>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex px-0 justify-content-between">
                                        <strong>Name</strong>
                                        <span class="mb-0">{{ $car->car_name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex px-0 justify-content-between">
                                        <strong>Price</strong>
                                        <span class="mb-0">${{ number_format($car->price) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex px-0 justify-content-between">
                                        <strong>Year</strong>
                                        <span class="mb-0">{{ $car->year }}</span>
                                    </li>
                                    <li class="list-group-item d-flex px-0 justify-content-between">
                                        <strong>Features</strong>
                                        <span class="mb-0">{{ $car->features }}</span>
                                    </li>
                                    <li class="list-group-item d-flex px-0 justify-content-between">
                                        <strong>Mileage</strong>
                                        <span class="mb-0">0 miles</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer pt-3 pb-3 text-center">
                                <span class="text-primary"><i class="fa fa-exclamation-circle"></i> Please Review the Information and Confirm</span>
                            </div>
                        </div>
                    </div>

                    <!-- Deposit Payment -->
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Deposit-Payment</h4>
                            </div>
                            <div class="card-body">
                                @if($coinType === 'bank_transfer')
                                    <p>Account Name: {{ $Account_name }}</p>
                                    <p>Bank Name: {{ $Bank_name }}</p>
                                    <p>Account Number: {{ $Account_number }}</p>
                                    <p>Routing Number: {{ $Routing_number }}</p>
                                    <p>Bank Address: {{ $Bank_address }}</p>

                                     <form action="{{ route('tesla.payment.upload', $car->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Hidden input for previously selected payment method -->
                                            <input type="hidden" name="payment_method" value="{{ $coinType }}">

                                          
                                            
                                            
                                                <p class="card-text">Upload Payment Proof (Screenshot)</p>
                                                <div class="input-group mb-3 row">
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control" name="proof_image">
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-grid gap-2">
                                                    <button type="submit" name="sub-depo" class="btn btn-success waves-effect btn-label waves-light">
                                                        <i class="bx bx-check-double label-icon"></i>
                                                        PAID
                                                    </button>
                                                </div>
                                           
                                        </form>
                                @else
                                    <div class="text-center">
                                        <p class="card-text">ADDRESS</p>
                                        <div class="mb-2" id="circle">
                                            <img src="{{ url('storage/qr_images/' . $qr) }}" style="border-radius: 10%; height: 150px;" alt="qrcode" />
                                        </div>
                                        <br>
                                        <form action="{{ route('tesla.payment.upload', $car->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Hidden input for previously selected payment method -->
                                            <input type="hidden" name="payment_method" value="{{ $coinType }}">

                                            <div class="input-group mb-3 input-warning-o">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">₿</span>
                                                </div>
                                                <input type="text" class="form-control" id="copy" value="{{ $walletAddress }}" readonly>
                                                <button type="button" onclick="myFunction()" class="btn btn-success" id="copyButton">Copy</button>
                                            </div>

                                            
                                            
                                                <p class="card-text">Upload Payment Proof (Screenshot)</p>
                                                <div class="input-group mb-3 row">
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control" name="proof_image">
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-grid gap-2">
                                                    <button type="submit" name="sub-depo" class="btn btn-success waves-effect btn-label waves-light">
                                                        <i class="bx bx-check-double label-icon"></i>
                                                        PAID
                                                    </button>
                                                </div>
                                           
                                        </form>
                                    </div>
                                @endif

                                <div class="card-footer">
                                    <ul>
                                        <li>
                                            <p class="card-text text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Be aware of that this order will be cancelled, if you send any other BTC amount.</p>
                                        </li>
                                        <li>
                                            <p class="card-text text-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Account will be credited once we receive your payment.</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
            const copyText = document.getElementById("copy");

            // Temporarily make input editable so it can be selected
            copyText.removeAttribute("readonly");
            copyText.focus();
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            try {
                const successful = document.execCommand("copy");
                if (successful) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Wallet address copied to clipboard.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    throw new Error("execCommand failed");
                }
            } catch (err) {
                console.error("Error copying text: ", err);
                alert("Failed to copy text. Please copy manually.");
            }

            // Reapply readonly
            copyText.setAttribute("readonly", true);
        }
    </script>
@endsection

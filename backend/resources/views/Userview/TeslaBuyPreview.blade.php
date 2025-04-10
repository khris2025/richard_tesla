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

               <div class="col-lg-7">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title">Payment Details</h4>
                     </div>
                     <div class="card-body">
                        <form action="{{ route('tesla.payment', $car ->id) }}" method="get" enctype="multipart/form-data">
                           @csrf
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">Payment Method</span>
                              </div>
                              <select class="form-control" name="payment_method" id="payment_method">
                                 <option value="">Select Payment Method</option>
                                 <option value="Bitcoin_bitcoin">Bitcoin (Network ~ Bitcoin)</option>
                                 <option value="Ethereum_erc20">Ethereum (Network ~ ERC20)</option>
                                 <option value="Ethereum_bep20">Ethereum (Network ~ BEP20)</option>
                                 <option value="USDT_trc20">USDT (Network ~ TRC20)</option>
                                 <option value="USDT_bep20">USDT (Network ~ BEP20)</option>
                                 <option value="USDT_erc20">USDT (Network ~ ERC20)</option>
                                 <option value="bank_transfer">Bank Transfer</option>
                              </select>
                           </div>
                           {{-- <div id="payment-details" class="mb-3">
                              <!-- Payment details will be displayed here -->
                           </div> --}}
                           <div class="mb-3 d-grid gap-2">
                              <button type="submit" name="sub-depo" class="btn btn-success waves-effect btn-label waves-light">
                              <i class="bx bx-check-double label-icon"></i>
                              Procced to Payment 
                              </button>
                           </div>
                        </form>
                       

                       
                     </div>
                     <div class="card-footer">
                        <ul>
                           <li>
                              <p class="card-text text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Please ensure all payment details are correct before proceeding.</p>
                           </li>
                           <li>
                              <p class="card-text text-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Your car will be reserved upon successful payment.</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
         $('#payment_method').change(function() {
            var paymentMethod = $(this).val();
            $.ajax({
               url: "{{ route('getPaymentDetails') }}",
               type: "POST",
               data: {
                  _token: "{{ csrf_token() }}",
                  payment_method: paymentMethod
               },
               success: function(response) {
                  $('#payment-details').html('<p>' + response.paymentDetails + '</p>');
               },
               error: function() {
                  alert('Error fetching payment details.');
               }
            });
         });
      });
   </script> --}}
@endsection

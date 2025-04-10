
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
                  {{-- <h4 class="mb-sm-0 font-size-18">Choose Plan</h4> --}}
                  <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        {{-- <li class="breadcrumb-item active">Choose Plan</li> --}}
                     </ol>
                  </div>
               </div>
               <!-- TradingView Widget -->
               <div class="tradingview-widget-container mb-3">
                  <div class="tradingview-widget-container__widget"></div>
                  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                     {
                     "symbols": [
                         {"proName": "FOREXCOM:SPXUSD", "title": "S&P 500"},
                         {"proName": "FOREXCOM:NSXUSD", "title": "US 100"},
                         {"proName": "FX_IDC:EURUSD", "title": "EUR/USD"},
                         {"proName": "BITSTAMP:BTCUSD", "title": "Bitcoin"},
                         {"proName": "BITSTAMP:ETHUSD", "title": "Ethereum"}
                     ],
                     "showSymbolLogo": true,
                     "colorTheme": "light",
                     "isTransparent": false,
                     "displayMode": "regular",
                     "locale": "en"
                     }
                  </script>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header d-flex">
                     <h4 class="card-title mb-0 flex-grow-1">Select a Tesla to BUY</h4>
                     <div class="flex-shrink-0 align-self-end">
                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" id="pills-tab" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link px-3 rounded monthly active" id="monthly" data-bs-toggle="pill" href="#month" role="tab" aria-controls="month" aria-selected="true">Order Tesla</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        @foreach($tesla_cars as $tesla)
                        <div class="col-xl-4 col-sm-6 mb-4">
                           <div class="card shadow-lg border-0">
                              <div class="position-relative">
                                 <img id="blah" src="{{ asset('storage/' . $tesla->car_img) }}" alt="Uploaded Image" class="img-fluid" style="max-width: 100%; max-height: 250px; object-fit: cover;">
                                 <span class="badge bg-primary position-absolute top-0 start-0 m-2">New</span>
                              </div>

                              <div class="card-body text-center">
                                 <h5 class="card-title font-weight-bold text-dark">{{ $tesla->model }}</h5>
                                 <p class="card-text text-muted">
                                    <strong>Price:</strong> <span class="text-success">${{ number_format($tesla->price, 2) }}</span><br>
                                    <strong>Year:</strong> {{ $tesla->year }}<br>
                                    <strong>Features:</strong> {{ $tesla->features }}<br>
                                    <strong>Vehicle History:</strong> {{ $tesla->history }}<br>
                                    <strong>Mileage:</strong> {{ $tesla->mileage }} miles<br>
                                 </p>
                                 <a href="{{ route('tesla.buy', $tesla->id) }}" class="btn btn-outline-primary w-100">Buy Now</a>

                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
        
      </div>
   </div>
</div>
@endsection
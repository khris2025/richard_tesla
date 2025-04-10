@extends('Adminview.layout.app')
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
               <h4 class="mb-sm-0 font-size-18">Add Tesla</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                     <li class="breadcrumb-item active">Add Tesla</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 col-sm-12 mt-4">
            <div class="card">
               <div class="card-header">
                  <h5 class="card-title">Add Tesla</h5>
               </div>
               <div class="card-body">
                  <form method="post" action="{{ route('store_tesla') }}" enctype="multipart/form-data">
                     @csrf
                     <div class="form-row">
                        <!-- Row 1: Picture of Car -->
                        <div class="row mt-4">
                           <div class="form-group col-md-6">
                              <label class="text-secondary">Picture of Car</label>
                              <div class="custom-file">
                                 <input type="file" class="form-control" name="car_img" accept="image/*" required>
                              </div>
                           </div>
                        </div>
                        <!-- Row 2: Name of Car and Price -->
                        <div class="row mt-4">
                           <div class="form-group col-md-6">
                              <label class="text-secondary">Name of Car</label>
                              <input type="text" name="car_name" class="form-control" placeholder="Enter car name" required>
                           </div>
                           <div class="form-group col-md-6">
                              <label class="text-secondary">Price ($)</label>
                              <input type="number" name="price" class="form-control" placeholder="Enter price" required>
                           </div>
                        </div>
                        <!-- Row 3: Year -->
                        <div class="row mt-4">
                           <div class="form-group col-md-6">
                              <label class="text-secondary">Year</label>
                              <input type="number" name="year" class="form-control" placeholder="Enter year" required>
                           </div>
                        </div>
                        <!-- Row 4: Features -->
                        <div class="row mt-4">
                           <div class="form-group col-md-12">
                              <label class="text-secondary">Features</label>
                              <textarea name="features" class="form-control" rows="4" placeholder="Enter features" required></textarea>
                           </div>
                        </div>
                     </div>
                     <!-- Submit Button -->
                     <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Upload</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
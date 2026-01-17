@extends('layouts.user_type.auth')

@section('content')
<section class="py-2 bg-gray-100"> 
    <div class="page-header align-items-end min-vh-25 pt-5 pb-4 mx-3 border-radius-lg" 
         style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}'); background-size: cover; background-position: center;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      
      <div class="container z-index-1"> 
        <div class="row">
            <div class="col-lg-6 col-md-8 text-start">
                <h3 class="text-white fw-bold mb-1">{{ $category->name }} Items</h3>
                <p class="text-white opacity-8 text-sm">Discover the best facilities to support your needs</p>
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                
                <div class="bootstrap-tabs product-tabs">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                                
                                @foreach($datas as $data)
                                    <div class="col">
                                        <div class="product-card">
                                            
                                            <a href="#" class="btn-wishlist">
                                                <i class="far fa-heart"></i>
                                            </a>

                                            <div class="product-image-wrapper">
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" class="product-image" alt="{{ $data->name }}">
                                                </a>
                                            </div>

                                            <a href="#" class="product-title">{{ $data->name }}</a>
                                            
                                            <div class="product-meta">
                                                <span class="d-block"> Available at</span>
                                                <span class="text-info fw-bold">
                                                    {{ $data->opening_time . ' - ' . $data->closing_time }}
                                                </span>
                                            </div>

                                            <div class="product-footer mt-3">
                                                <button type="button" class="btn-booking border-1 w-100" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#bookingModal"
                                                    data-id="{{ $data->id }}"
                                                    data-name="{{ $data->name }}"
                                                    data-open="{{ $data->opening_time }}" {{-- Format: 08:00:00 --}}
                                                    data-close="{{ $data->closing_time }}"
                                                    data-duration="{{ $data->max_book_duration }}">
                                                    Booking Now
                                                </button>
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
</section>

{{-- MODAL BOOKING --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Book <span id="modalItemName"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ route('org.user-booking-store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <input type="hidden" name="item_id" id="inputItemId">
            <input type="hidden" name="start_time" id="inputStartTime">
            <input type="hidden" name="end_time" id="inputEndTime">

            <div class="mb-3">
                <label for="bookingDate" class="form-label fw-bold">Select Date</label>
                <input type="date" class="form-control" id="bookingDate" name="booking_date" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Select Time Slot</label>
                <div id="timeSlotContainer" class="d-grid gap-2" style="grid-template-columns: 1fr 1fr;">
                    <p class="text-muted text-sm fst-italic grid-column-span-2">Please select a date first.</p>
                </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info text-white btn-submit-booking" id="btnSubmitBooking" disabled>Confirm Booking</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('dashboard')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentItem = {};

    const bookingButtons = document.querySelectorAll('.btn-booking');
    bookingButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Simpan sementara
            currentItem = {
                id: this.dataset.id,
                open: this.dataset.open,     
                close: this.dataset.close,   
                duration: parseInt(this.dataset.duration) 
            };

            document.getElementById('modalItemName').textContent = this.dataset.name;
            document.getElementById('inputItemId').value = currentItem.id;
            
            document.getElementById('bookingDate').value = '';
            document.getElementById('timeSlotContainer').innerHTML = '<p class="text-muted text-sm fst-italic" style="grid-column: span 2;">Please select a date first.</p>';
            document.getElementById('btnSubmitBooking').disabled = true;
            document.getElementById('inputStartTime').value = '';
            document.getElementById('inputEndTime').value = '';
        });
    });

    // Saat Tanggal Dipilih
    document.getElementById('bookingDate').addEventListener('change', function() {
        const selectedDate = this.value;
        if (!selectedDate || !currentItem.id) return;

        // Loading
        const container = document.getElementById('timeSlotContainer');
        container.innerHTML = '<p class="text-muted text-sm" style="grid-column: span 2;">Checking availability...</p>';

        fetch(`{{ route('org.user-booking-check') }}?item_id=${currentItem.id}&date=${selectedDate}`)
            .then(response => response.json())
            .then(bookedSlots => {
                generateTimeSlots(bookedSlots);
            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML = '<p class="text-danger text-sm">Failed to load slots.</p>';
            });
    });

    function generateTimeSlots(bookedSlots) {
        const container = document.getElementById('timeSlotContainer');
        container.innerHTML = ''; 

        let startHour = parseInt(currentItem.open.split(':')[0]); 
        let endHour = parseInt(currentItem.close.split(':')[0]);
        let duration = currentItem.duration;

        for (let hour = startHour; hour < endHour; hour += duration) {
            if (hour + duration > endHour) break;

            let slotStartValue = hour.toString().padStart(2, '0') + ':00:00';
            let slotEndValue = (hour + duration).toString().padStart(2, '0') + ':00:00';

            let labelStart = hour.toString().padStart(2, '0') + ':00';
            let labelEnd = (hour + duration).toString().padStart(2, '0') + ':00';

            let isBooked = bookedSlots.includes(slotStartValue);

            let btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'time-slot-btn';
            btn.textContent = `${labelStart} - ${labelEnd}`;
            
            if (isBooked) {
                btn.disabled = true;
                btn.title = "Already booked";
            } else {
                btn.onclick = function() {
                    document.querySelectorAll('.time-slot-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    document.getElementById('inputStartTime').value = slotStartValue;
                    document.getElementById('inputEndTime').value = slotEndValue;
                
                    document.getElementById('btnSubmitBooking').disabled = false;
                };
            }

            container.appendChild(btn);
        }

        if (container.children.length === 0) {
            container.innerHTML = '<p class="text-warning text-sm">No slots available according to configuration.</p>';
        }
    }
});
</script>
@endpush
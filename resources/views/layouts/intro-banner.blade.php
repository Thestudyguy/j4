
    <div class="intro-banner p-5" id="home">
        {{-- <img src="{{ asset('images/banner2.jpeg') }}" alt="" style="object-fit: contain;"> --}}
        <div class="intro-text-container">
            <div class="row p-5">
                <div class="col p-5">
                    <div class="banner-header">
                        <div class="banner-text">
                            <h1 class="banner-header-text">Professional Dental Dental Care Solutions</h1>
                        </div>
                        <div class="banner-sub-text mb-5">
                            Experience the pinnacle of oral health with Professional Dental Care Solutions. Our dentist is dedicated to providing comprehensive dental care tailored to your unique needs.
                        </div>
                        <div class="banner-super-sub-text">
                            <button style="background-color: #20536B" class="text-white btn rounded-5 p-2 mx-2 px-4" data-bs-target="#client-appointment-form" data-bs-toggle="modal">
                                BOOK AN APPOINTMENT
                            </button>
                            @include('modals.appointment-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>

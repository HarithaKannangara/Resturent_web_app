@extends('user.layout.front', ['main_page' => 'yes'])

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="user/asset/img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>
</div>


<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Cook's Menu</h5>
            <h1 class="mb-5">Most Popular Items</h1>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fa fa-coffee fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Popular</small>
                            <h6 class="mt-n1 mb-0">Menu</h6>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Special</small>
                            <h6 class="mt-n1 mb-0">Favorite</h6>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- Concessions Section -->
            <div class="tab-content">
                <!-- All Concessions -->
                <div class="tab-pane fade show active" id="tab-1">
                    <div class="row g-4">
                        @foreach ($concessions as $concession)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="menu-item bg-light rounded d-flex align-items-center p-4">
                                    <img src="{{ asset($concession->image_path) }}" alt="{{ $concession->name }}" class="img-fluid rounded-circle" style="width: 75px; height: 75px; object-fit: cover;">
                                    <div class="w-100 ms-3">
                                        <h5 class="mb-1">{{ $concession->name }}</h5>
                                        <small class="text-body">{{ $concession->description }}</small>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <p class="mb-0" style="font-weight: bold;">${{ number_format($concession->price, 2) }}</p>
                                            <button class="btn btn-sm btn-light" style="border: none;" data-id="{{ $concession->id }}" onclick="addToFavorites({{ $concession->id }})">
                                                <i class="fa fa-star text-warning"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Favorite Concessions -->
                <div class="tab-pane fade" id="tab-2">
                    <div class="row g-4" id="favorites-container">
                        <!-- Favorite items will be dynamically added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->

<script>
    let favorites = [];

    function addToFavorites(concessionId) {
    const concessionElement = document.querySelector(`[data-id="${concessionId}"]`).closest('.col-lg-4');

    if (!concessionElement) {
        alert("Item not found. Please try again!");
        return;
    }

    // Check if the concession is already in favorites
    if (!favorites.includes(concessionId)) {
        favorites.push(concessionId);

        // Clone the element and add it to the favorites section
        const clonedElement = concessionElement.cloneNode(true);
        clonedElement.querySelector('button').remove(); // Remove the "add to favorites" button
        document.getElementById('favorites-container').appendChild(clonedElement);
    } else {
        alert("This item is already in favorites!");
    }
}
</script>


<!-- Service Start -->
<div class="container-xxl py-5" >
    <div class="container" style="padding-top: 50px">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                        <h5>Master Chefs</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                        <h5>Quality Food</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                        <h5>Online Order</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item rounded pt-3">
                    <div class="p-4">
                        <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                        <h5>24/7 Service</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->














@endsection

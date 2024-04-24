@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-5" id='nav1'>
        <div class="row py-2 px-xl-5">
    <section class="banner py-5">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8 mx-auto text-center">
                    <h1 class="display-3">Welcome to the Commission Site</h1>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi purus luctus,
                        vitae velit tincidunt turpis inceptos convallis ad sem fermentum netus ante, eleifend
                        pellentesque aliquet senectus porttitor phasellus non commodo aenean.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-posts py-5">
        <div class="container">
            <a class=" btn btn-primary" href="{{route('users.add')}}" >Add Users</a>
           {{-- <a class ="btn btn-primary" href="{{route('')}}" --}}
        </div>
    </section>
</div>
</div>
@endsection

@extends('frontend.index')
@section('main-section')
    <div class="container center-box">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="heading-box">
                    <h3>www<span>.Schipholtaxi</span>.Taxi</h3>
                    <p>השותף האמין שלך בהובלה לשדה התעופה</p>
                </div>
                <div class="transperant-box">
                    <p><strong>אמסטלווין לסכיפהול ושיבה</strong></p>

                    <a href="tel:+31850600505" class="btn-num">085-060 05 05</a>
                    <div class="button-box">
                        <p>נדרשת הזמנה מראש</p>
                        <p>Foreign countries +31651044996</p>
                        <form method="post" action="{{ route('reserve') }}" method="post">
                            @csrf
                            <div class="input-box">
                                <input type="text" name="pickup_address" placeholder="Your Pickup Address"
                                    class="form-control pg-autocomplete">
                                <button type="button" class="pg-track-location"><i
                                        class="fa-solid fa-location-crosshairs"></i></button>
                            </div>
                            <input type="submit" class="reserv" value="RESERVE">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('inc.home-links')
    </div>
@endsection

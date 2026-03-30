<!DOCTYPE html>
<html>

<head>
    <title>Booking Confirmation</title>
</head>

<body>
    <h1>Booking Confirmation</h1>
    <p>Thank you for your booking. Here are the details:</p>

    <p><strong>Date, Time:</strong> {{ $bookingDetails['pickup_date'] }} at {{ $bookingDetails['pickup_time'] }}</p>


    @if (preg_match('/^Pax *$/', $bookingDetails['press']))
        <p><strong>Passenger(s):</strong> </p>
    @else
        <p><strong>Passenger(s):</strong> {{ $bookingDetails['press'] }}</p>
    @endif
    @if (preg_match('/^Luggage *$/', $bookingDetails['luggage']))
        <p><strong>Luggage:</strong></p>
    @else
        <p><strong>Luggage:</strong> {{ $bookingDetails['luggage'] }}</p>
    @endif
    <p><strong>Vehicle:</strong> {{ $bookingDetails['vehicle'] }}</p>
    @if (trim($bookingDetails['house_no_from']) === 'House no')
        <p><strong>From:</strong> {{ $bookingDetails['pickup_address'] }}</p>
    @else
        <p><strong>From:</strong> {{ $bookingDetails['pickup_address'] }}
            {{ $bookingDetails['house_no_from'] }}</p>
    @endif

    @if (trim($bookingDetails['house_no_to']) === 'House no')
        <p><strong>To:</strong> {{ $bookingDetails['to'] }}</p>
    @else
        <p><strong>To:</strong> {{ $bookingDetails['to'] }} {{ $bookingDetails['house_no_to'] }}</p>
    @endif
    <p><strong>Price:</strong>
        Customer: Test

        {{ $bookingDetails['price'] }}

    </p>

    <p><strong>Payment Mode:</strong> {{ $bookingDetails['mode'] }}</p>
    @isset($bookingDetails['email'])
        <p><strong>Contact Info:</strong> Mobile: {{ $bookingDetails['mobile'] }}, Email: {{ $bookingDetails['email'] }},
            Name: {{ $bookingDetails['uname'] }}</p>
    @else
        <p><strong>Contact Info:</strong> Mobile: {{ $bookingDetails['mobile'] }}, Name: {{ $bookingDetails['uname'] }}
        </p>
    @endisset

    <p><strong>Return Booking:</strong> {{ $bookingDetails['return'] }}</p>
    @if ($bookingDetails['return'] == 'Yes')
        <p><strong>Flight Details:</strong> No: {{ $bookingDetails['flight_no_on_return'] }}, Date:
            {{ $bookingDetails['flight_date'] }}, Time: {{ $bookingDetails['flight_time'] }}</p>
    @endif
    <p><strong>Remark:</strong> {{ $bookingDetails['remark'] }}</p>

    <p>Met vriendelijke groet,</p>
    Roy /www.spl.taxi<br>
    info@spl.taxi<br>
    06-51044996<br>
    085 - 060 05 05<br>
    020 - 681 38 37

</body>

</html>

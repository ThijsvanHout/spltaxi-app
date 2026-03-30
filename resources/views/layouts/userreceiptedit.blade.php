<style>
    .table {
        width: 65%;
        table-layout: fixed;
    }

    .table td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table input {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        -webkit-appearance: none;
        /* mobiel safari */
        appearance: none;
    }
</style>
<div class="content-wrapper">
    <form id="edit-user-receipt" method="POST" action="{{ route('user-receipt-email2') }}">
        @csrf
        <h3>Booking receipt</h3>
        <table class="table table-responsive-lg table-bordered" border="1">
            <colgroup>
                <col style="width:30%">
                <col style="width:70%">
            </colgroup>
            <tbody>
                <tr>
                    <td><label>Name</label></td>
                    <td hidden><input type="text" name="name" value="{{ $booking->name }}" readonly></td>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" value="{{ $booking->email }}" name="email"></td>
                </tr>
                <tr>
                    <td><label>Pickup Address</label></td>
                    <td hidden><input class="form=control" type="text" name="pickup_address"
                            value="{{ $booking->pickup_address }}" readonly></td>
                    <td>{{ $booking->pickup_address }}</td>
                </tr>
                <tr>
                    <td><label>Destination</label></td>
                    <td hidden><input type="text" name="destination" value="{{ $booking->destination }}" readonly>
                    </td>
                    <td>{{ $booking->destination }}</td>
                </tr>
                <tr>
                    <td><label>Number of Persons</label></td>
                    <td hidden><input type="text" name="press" value="{{ $booking->press }}" readonly></td>
                    <td>{{ $booking->press }}</td>
                </tr>
                <tr>
                    <td><label>Date</label></td>
                    <td hidden><input type="text" name="pickup_date" value="{{ $booking->pickup_date }}" readonly>
                    </td>
                    <td>{{ $booking->pickup_date }}</td>
                </tr>
                <tr>
                    <td><label>Time</label></td>
                    <td hidden><input type="text" name="pickup_time" value="{{ $booking->pickup_time }}" readonly>
                    </td>
                    <td>{{ $booking->pickup_time }}</td>
                </tr>
                <tr>
                    <td><label>Price</label></td>
                    <td><input type="number" step="0.01" value="{{ $booking->price }}"></td>
                </tr>
            </tbody>
        </table>

        <br />
        <div class="row">
            <div>
                <button type="submit" class="btn btn-primary">Verzend email</button>
            </div>
        </div>
    </form>
</div>

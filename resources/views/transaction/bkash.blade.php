<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">bKash Payment Confirmation</h3>
    </div>

    <div class="panel-body">
            @if($transaction_status == '0000')
                    echo "<div class='alert alert-success'>Transaction Successful. trxID is valid and transaction is successful.</div>";


            @elseif($transaction_status == '0010')
                    echo "<div class='alert alert-warning'>Transaction Pending... trxID is valid but transaction is in pending state.</div>";

            @elseif($transaction_status == '0011')
                    echo "<div class='alert alert-warning'>Transaction Pending... trxID is valid but transaction is in pending state.</div>";


            @elseif($transaction_status == '0100')
                    echo "<div class='alert alert-danger'>Transaction Reversed ! trxID is valid but transaction has been reversed.</div>";


            @elseif($transaction_status == '0111')
                    echo "<div class='alert alert-danger'>Transaction Failure ! trxID is valid but transaction has failed.</div>";


            @elseif($transaction_status == '1001')
                    echo "<div class='alert alert-danger'>Format Error ! Invalid MSISDN input. Try with correct mobile no.</div>";


            @elseif($transaction_status == '1002')
                    echo "<div class='alert alert-danger'>Invalid Reference ! Invalid trxID, it does not exist.</div>";


            @elseif($transaction_status == '1003')
                    echo "<div class='alert alert-danger'>Authorization Error ! Access denied. Username or Password is incorrect.</div>";

            @elseif($transaction_status == '1004')
                    echo "<div class='alert alert-danger'>Authorization Error ! Access denied. trxID is not related to this username.</div>";


            @elseif($transaction_status == '9999')
                    echo "<div class='alert alert-danger'>System Error ! Could not process request.</div>";


            @else
                    echo "<div class='alert alert-danger'>Unknown ERROR !</div>";
        @endif

        // Print Transaction Information

        <b>Amount :</b> {{ $transaction_amount }} <br><br>

        <b>Reference :</b> {{ $transaction_reference }} <br><br>

        <b>Time :</b> {{ $transaction_time }} <br><br><br>

        // Invoice Generate

        <a href="{{ url('get-invoice') }}" class="btn btn-primary">{{ 'Click Here to Get Invoice' }}</a>
    </div>
</div>

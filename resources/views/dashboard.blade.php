@extends('layouts.main')

@section('content-2')
<div class="row form-group align-items-center p-2">
    <div class="col-md-10 my-1">
        <input type="text" class="form-control" name="username" placeholder="Enter member QR code">
        
    </div>
    <div class="col-md-2 my-1">
        <!-- <button id="" type="submit" class="btn btn-primary mr-2 btn-rounded-4"> -->
        <button id="qr-scanner" type="button" class="btn btn-primary mr-2 btn-rounded-4" data-toggle="modal" data-target="#qrModal">
            <i class="fa icon-qr-1"></i>Scan QR Code
        </button>
    </div>
    
</div>

<script type="text/javascript">
    var qr_code = "{{ app('request')->input('qr_code') }}";

    function getScan() {
        $.get('/getScan', (data) => {
            console.log(data);
            if (data && data.qr_code && qr_code != data.qr_code) {
                location.href = '/dashboard?qr_code=' + data.qr_code;
            }

            setTimeout(() => {   
                getScan()
            }, 3000);
        });
    }

    getScan();
</script>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script type="text/javascript">
    //const
    // io = require("socket.io-client"),
    // io.set('origins', 'http://192.168.137.35:8002');
    var socket = io.connect("http://192.168.137.35:8002");
    socket.on("broadcastTest", (msg) => console.log(msg));
    socket.on("connection", () => {
        console.log('test');
    });

    // ioClient = io.connect("http://192.168.137.1:8002");

    // ioClient.on("broadcastTest", (msg) => console.info(msg));
</script> -->

@if(app('request')->input('qr_code') && $data)
    @include('includes.search-result')
@else
    @include('includes.search-status')
@endif

@endsection
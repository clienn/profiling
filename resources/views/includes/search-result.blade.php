<div id="general-info" class="row mt-5">
    <div class="col-md-4 p-5 d-flex justify-content-center self-align-center">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('images/pics') }}/{{ $data->username }}.png" class="rounded-circle" 
                            width="100px" height="100px" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-4 text-center">
                        <h1 class="header-1 font-light">
                            {{ $data->firstname }} {{ $data->lastname }}
                        </h1>
                        <div class="fc-1">{{ $data->username }}</div>
                        <div>
                            <img src="{{ asset('images/signatures') }}/{{ $data->username }}.png"
                                width="100px" height="100px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="col-md-4 pt-4 mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h1 class="header-5 font-regular font-weight-bold">General Information</h1>
                    </div>
                </div>
                <div class="row mt-4 pt-1">
                    <div class="col-md-5 text-left fc-1">
                        <span>Classification:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">Member</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Firstname:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->firstname }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Lastname:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->lastname }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Middlename:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->middlename }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Age:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->age }}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Status:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">Single</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-5 text-left fc-1">
                        <span>Birthdate:</span>
                    </div>
                    <div class="col-md-7 text-left">
                        <span class="font-weight-bold">{{ $data->birthdate }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="col-md-12 pt-5">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>Contact:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <span class="font-weight-bold">{{ $data->contact }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>Address:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <span class="font-weight-bold">{{ $data->address }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 text-left fc-1">
                            <span>QR Code:</span>
                        </div>
                        <div class="col-md-7 text-left">
                            <div 
                                id="qrcode" 
                                style="width:100px;height:100px;position:relative;">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row text-right mb-2" style="margin-top:7em;">
    <div class="col-md-12">
        <span class="mr-2 m-nt-1">@include('svg.save-file-icon')</span>
        <span class="fc-1 font-regular font-weight-bold pr-2 mt-5">Save Information</span>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 100,
            height : 100
        });

        qrcode.makeCode("{{ $data->username }}");
    });
</script>
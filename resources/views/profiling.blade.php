@extends('layouts.main')

<style>
    .input-curve {
        background-color: transparent;
        border: 1px solid #b8b8b8 !important;
        /* border-bottom: 1px solid #b8b8b8 !important; */
        /* color: #fff !important; */
        border-radius: 1rem !important;
        font-size:12px !important;
        z-index:99999999 !important;
    }

    .form-control-curve {
        -webkit-border-radius: 2em;
            -moz-border-radius: 2em;
                border-radius: 2em;
    }

    .profiling {
        /* height:160vh !important; */
    }

    .image-upload {
        cursor:pointer;
    }

    .image-upload > input {
        display: none;
    }

</style>

@section('content-2')
<form id="memberForm" action="{{ env('APP_URL', '127.0.0.1:8000') }}/register" method="POST" autocomplete="off" autofill="off">
{{ csrf_field() }}

<input type="hidden" name="imgbase64" value="" />
<input type="hidden" name="sigbase64" value="" />

<div class="row form-group align-items-center p-4">
    <div class="col-md-12 my-1">
        <h1 class="header-1 font-light fc-1">Create Accounts</h1>
        
    </div>
    <div class="col-md-10 my-1">
        <input type="text" class="form-control header-8" name="search" placeholder="Enter member QR code">
    </div>
    <div class="col-md-2 my-1">
        <!-- <button type="button" class="btn btn-primary mr-2 btn-rounded-4"> -->
        <button id="qr-scanner" type="button" class="btn btn-primary border-0 mr-2 btn-rounded-4" data-toggle="modal" data-target="#qrModal">
            <i class="fa icon-qr-1"></i>Scan QR Code
        </button>
    </div>
</div>

<div class="row form-group align-items-center p-5">
    <a id="triggerCamera" href="#cameraModal" data-toggle="modal" data-target="#cameraModal">
        <div id="results" class="hidden col-md-2 my-1"></div>
        <div id="svg-upload-photo" class="col-md-2 my-1">
            @include('svg.upload-photo')
        </div>
    </a>
    <div class="col-md-3 my-1">
        <span class="header-4 font-weight-bold">Upload profile picture</span>
        <p class="header-10 fc-1 font-light font-weight-bold">*Click on the camera icon to to start taking member picture.</p>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-2 my-1">
                <span class="header-8 fc-1 font-light ">Select privileges*</span>
            </div>
            <div class="col-md-2 my-1">
                <select name="classification_id" class="form-control fc-1 font-regular header-10 input-curve p-2" id="sel1">
                    <option value="" selected disabled>Classification</option>
                    @foreach($classifications as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 my-1">
                <select name="branch_id" class="form-control fc-1 font-regular header-10 input-curve p-2" id="sel2">
                    <option value="" selected disabled>Branch name</option>
                    @foreach($branches as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">General Information</h1>
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="firstname" placeholder="Firstname">
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="lastname" placeholder="Lastname">   
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="middlename" placeholder="Middlename">   
            </div>
            
        </div>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-2 my-1">
                <input type="text" style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="birthdate" placeholder="Birthdate">   
            </div>
            <div class="col-md-2 my-1">
                <!-- <input type="text" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="status" placeholder="Status"> -->

                <select name="status" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    style="margin-top:-7em !important;"
                    id="sel3">
                    <option value="" selected disabled>Status</option>
                    <option value="New">New</option>
                    <option value="Re-Entry">Re-Entry</option>
                </select>
            </div>
            <div class="col-md-4 my-1 pl-4">
                <div class="image-upload" style="margin-top:-7em !important;">
                    <label for="file-input">
                        <img id="signature" class="hidden" alt="member signature" />
                        @include('svg.import-signature-icon')
                    </label>
                    <input id="file-input" type="file" onchange="readURL(this);" />
                    <!-- <div class="btn btn-primary btn-sm float-left">
                        <span>Choose file</span>
                        
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-7em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">Contact Address</h1>
            </div>
            <div class="col-md-2 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="address" placeholder="Address">
            </div>
            <div class="col-md-2 my-1">
                <input type="number" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="contact" placeholder="Contact">   
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-12 my-1">
                <h1 class="header-4 font-light fc-1 font-weight-bold">Login Credentials</h1>
            </div>
            <div class="col-md-3 my-1">
                <input type="text" class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="username" placeholder="Member Code" autocomplete="off" readonly="true">
            </div>
            <div class="col-md-3 my-1">
                <p class="header-10 fc-1 font-light font-weight-bold">*Autogenerated QR Code.</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 my-1">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-3 my-1">
                <input type="password" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="password" placeholder="Password" autocomplete="new-password" value="">
            </div>
            <div class="col-md-3 my-1">
                <input type="password" 
                    style="margin-top:-7em !important;"
                    class="form-control fc-1 font-regular header-10 input-curve p-2" 
                    name="password_confirmation" placeholder="Confirm Password" value="">
            </div>
            <div class="col-md-3 my-1" style="margin-top:-10em !important;">
                <a id="showPassword" href="#" class="nostyle">
                    @include('svg.view-eye-icon')
                </a>
            </div> 
        </div>
    </div>

    <div class="col-md-12 my-1" style="margin-top:-5em !important;">
        <div class="row form-group align-items-center p-5">
            <div class="col-md-1 my-1">
                <div>
                    <div 
                        id="qrcode" 
                        style="width:100px;height:100px;position:relative;">
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-1 ml-5">
                <div class="row form-group align-items-center">
                    <div class="col-md-12 my-1">
                        <p class="header-10 fc-1 font-light font-weight-bold">
                            *Click on the generate "QR Code button" to create member QR Code.
                        </p>
                    </div>
                    <div class="col-md-6 my-1">
                        <button id="qr-generator" type="submit" class="btn btn-primary border-0 mr-2 btn-rounded-4">
                            Generate QR Code
                        </button>
                    </div>
                    <div class="col-md-5 my-1">
                        <span>Download QR Code Image</span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 my-1 ml-5">
                <hr />
            </div>

            <div class="col-md-12 btn-toolbar btn-lg d-flex justify-content-end">
                <button id="cancelUpdate" type="button" 
                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Cancel
                </button>
                <button id="updateMember" type="submit" 
                    class="hidden btn btn-curve mr-2 btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Update
                </button>
                <a id="openPrint" href="#printModal" data-toggle="modal" data-target="#printModal">
                    <span class="fc-1 font-regular font-weight-bold pr-2 mt-5">View ID</span>
                </a>
                <button id="createMember" type="submit" 
                    class="btn btn-curve btn-rounded-3 bgc-1 fc-0 font-light header-8">
                    Create Member
                </button>
            </div>
        </div> 
    </div>
</div>
</form>

<input type="hidden" name="member_id" />
<div id="cameraModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width:350px;padding:1em;">
            <div id="my_camera"></div>
            <!-- <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
            
            <button id="captureImage" type="button" class="btn btn-primary mt-1">Capture Image</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printModalLabel">Member ID Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <canvas id="canvas" width="1011" height="641" class="hidden"></canvas>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front" id="card-front">
                    @include('svg.leader-card-front')
                    @include('svg.staff-card-front')
                    @include('svg.member-card-front')
                </div>
                <div class="flip-card-back" id="card-back">
                    @include('svg.leader-card-back')
                    @include('svg.staff-card-back')
                    @include('svg.member-card-back')
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="save-img" type="button" class="btn btn-secondary" data-dismiss="modal">Save Image</button>
        <button id="print-btn" type="button" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    svgeq = 0;
    $(document).ready(function() {
        var rotation = 0;

        $('#sel1').change(function() {
            if ($(this).val() == 3) {
                $('input[name="password"]').attr('disabled', true);
                $('input[name="password_confirmation"]').attr('disabled', true);
            } else {
                $('input[name="password"]').attr('disabled', false);
                $('input[name="password_confirmation"]').attr('disabled', false);
            }
        });

        $('.flip-card').click(function() {
            rotation = (rotation + 180) % 360
            svgeq = (svgeq + 1) % 2;
            $('.flip-card-inner', this).css({
                transform: 'rotateY(' + rotation + 'deg)'
            });
        });

        $('#printModal').on('show.bs.modal', function () {
            fillFrontCard();
            fillBackCard();
        });

        $('#print-btn').click(function() {
            printDiv();
        });
        
        $('#save-img').click(function() {
            //saveImage($(".card-id:eq(" + svgeq+ ")")[0]);
            let classification_id = $('#sel1').val();
            let classification = classification_id ? classification_id : 1;
            let username = $('input[name="username"]').val();
            let cardFront = $('#card-front svg.card-id:eq(' + (classification - 1) + ')');
            let cardBack = $('#card-back svg.card-id:eq(' + (classification - 1) + ')');
            
            saveImage(cardFront[0], username + '-front');
            saveImage(cardBack[0], username + '-back');
        });

        generateQRCode('');

        $('input[name="birthdate"]').datepicker();

        $('input[name="search"]').keyup(function(e) {
            if (e.keyCode == 13) {
                getUpdateData();
            }
        });

        $('#showPassword').click(function() {
            let t = $('input[name="password"]').attr('type');
            if (t == 'password') {
                $('input[name="password"]').attr('type', 'text');
                $('input[name="password_confirmation"]').attr('type', 'text');
            } else {
                $('input[name="password"]').attr('type', 'password');
                $('input[name="password_confirmation"]').attr('type', 'password');
            }
        });

        $('#qrModal').on('hidden.bs.modal', function () {
            if ($('#search').val() != "") {
                getUpdateData();
            }
        });

        $('#cancelUpdate').click(function() {
            $('#updateMember').addClass('hidden');
            $('#cancelUpdate').addClass('hidden');
            $('#createMember').removeClass('hidden');

            $('#sel1 option:eq(0)').attr('selected', true);
            $('#sel2 option:eq(0)').attr('selected', true);
            $('#sel3 option:eq(0)').attr('selected', true);

            $('input[name="search"]').val('');
            $('input[name="member_id"]').val('');
            $('input[name="firstname"]').val('');
            $('input[name="lastname"]').val('');
            $('input[name="middlename"]').val('');
            $('input[name="birthdate"]').val('');
            //$('input[name="status"]').val('');
            $('input[name="address"]').val('');
            $('input[name="contact"]').val('');
            $('input[name="username"]').val('');
            $('input[name="password"]').val('');
            $('input[name="password_confirmation"]').val('');

            $('#results').html("");
            $('#svg-upload-photo').removeClass('hidden');
            $('#results').addClass('hidden');
            $('#signature').addClass('hidden');
            $('input[name="username"]').attr('disabled', false);

            $('#qr-generator').attr('disabled', false);
            generateQRCode('');
        });

        $('#updateMember').click(function(e) {
            e.preventDefault();

            let img = document.getElementById("imageprev");
            let sig = document.getElementById("signature");

            let imgsrc = img ? img.src : '';
            let sigsrc = sig ? sig.src : '';

            let imgbase64 = '';
            let sigbase64 = '';

            getDataUri(imgsrc, function(dataUri) {
                imgbase64 = dataUri;

                getDataUri(sigsrc, function(dataUri) {
                    sigbase64 = dataUri;

                    let member = JSON.stringify({
                        'id': $('input[name="member_id"]').val(),
                        'firstname': $('input[name="firstname"]').val(),
                        'lastname': $('input[name="lastname"]').val(),
                        'middlename': $('input[name="middlename"]').val(),
                        'birthdate': $('input[name="birthdate"]').val(),
                        'status': $('#sel3').val(),
                        'address': $('input[name="address"]').val(),
                        'contact': $('input[name="contact"]').val(),
                        'username': $('input[name="username"]').val(),
                        'password': $('input[name="password"]').val(),
                        'classification_id': $('#sel1').val(),
                        'branch_id': $('#sel2').val(),
                        'imgbase64': imgbase64,
                        'sigbase64': sigbase64
                    });
                    // console.log(member);
                    if (validateFields(2)) {
                        apiCall(
                            "{{ env('API_URL', '127.0.0.1:8001') }}/api/member/", 'PUT', 
                            member,
                            (data) => {
                                alert('Successfully updated member.');
                            }
                        );
                    } else {
                        alert('Please fill in all fields.')
                    }
                });
            });
            
        });

        $('#createMember').click(function(e) {
            e.preventDefault();

            if (validateFields(1)) {
                // Get base64 value from <img id='imageprev'> source
                let img = document.getElementById("imageprev");
                let sig = document.getElementById("signature");

                let imgbase64 = img ? img.src : '';
                let sigbase64 = sig ? sig.src : '';

                $('input[name="imgbase64"]').val(imgbase64);
                $('input[name="sigbase64"]').val(sigbase64);

                $('#memberForm').submit();
            } else {
                alert('Please fill in all fields.')
            }
        });

        $('#qr-generator').click(function(e) {
            e.preventDefault();

            var d = new Date();
            var year = d.getFullYear();
            let code = makeid(8);

            let nextid = '{{ $nextid }}';
            let len = Math.min(8, nextid.length);
            code = code.slice(0, -len) + nextid;
            code = 'QRKP-' + code + '-' + year;
            
            $('input[name="username"]').val(code);
            generateQRCode(code);
        });
        
        <!-- Configure a few settings and attach camera -->

        $('#triggerCamera').click(function() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 100
            });

            Webcam.attach('#my_camera');
        });

        $('#cameraModal').on('hidden.bs.modal', function () {
            Webcam.reset();
        });

        <!-- Code to handle taking the snapshot and displaying it locally -->
        $('#captureImage').click(function() {
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML = 
                    '<img id="imageprev" src="'+data_uri+'" width="240" height="180" />';

                $('#results').removeClass('hidden');
                $('#svg-upload-photo').addClass('hidden');
            });
        });
        
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#signature')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(75);
            };

            $('#signature').removeClass('hidden');
            reader.readAsDataURL(input.files[0]);
        }
    }

    function generateQRCode(code) {
        document.getElementById("qrcode").innerHTML = '';

        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 100,
            height : 100
        });

        qrcode.makeCode(code);
    }

    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var charactersLength = characters.length;
        
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
       
        return result;
    }

    function validateFields(x) {
        let classification_id = $('#sel1').val();
        let branch_id = $('#sel2').val();
        let firstname = $('input[name="firstname"]').val();
        let lastname = $('input[name="lastname"]').val();
        let middlename = $('input[name="middlename"]').val();
        let birthdate = $('input[name="birthdate"]').val();
        let status = $('#sel3').val();
        let address = $('input[name="address"]').val();
        let contact = $('input[name="contact"]').val();
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
        let password_confirmation = $('input[name="password_confirmation"]').val();

        let img = document.getElementById("imageprev");
        let sig = document.getElementById("signature");

        let imgsrc = img ? img.src : '';
        let sigsrc = sig ? sig.src : '';

        if (x == 2) {
            if (password != "") {
                if (password != password_confirmation) return false;
            }
        }

        if (classification_id < 3) {
            if (password == "" || password != password_confirmation) {
                return false;
            } 
        }
        
        return (
            firstname && lastname && middlename && birthdate && classification_id && 
            branch_id && status && address && contact && username && imgsrc && sigsrc 
        );
    }

    function getUpdateData() {
        apiCall(
            "{{ env('API_URL', '127.0.0.1:8001') }}/api/member/" + $('input[name="search"]').val(), 'GET', 
            '',
            (data) => {
                if (data['classification_id']) {
                    $('#sel1 option').each(function() {
                        if ($(this).val() == data['classification_id']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                if (data['branch_id']) {
                    $('#sel2 option').each(function() {
                        if ($(this).val() == data['branch_id']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                if (data['status']) {
                    $('#sel3 option').each(function() {
                        if ($(this).val() == data['status']) {
                            $(this).attr('selected', true);
                        } else {
                            $(this).attr('selected', false);
                        }
                    });
                }

                $('input[name="member_id"]').val(data['id']);
                $('input[name="firstname"]').val(data['firstname']);
                $('input[name="lastname"]').val(data['lastname']);
                $('input[name="middlename"]').val(data['middlename']);
                $('input[name="birthdate"]').val(data['birthdate']);
                //$('input[name="status"]').val(data['status']);
                $('input[name="address"]').val(data['address']);
                $('input[name="contact"]').val(data['contact']);
                $('input[name="username"]').val(data['username']);

                generateQRCode(data['username']);

                let picPath = "{{ env('APP_URL', '127.0.0.1:8000') }}/images/pics/" + data['username'] + '.png';
                let sigPath = "{{ env('APP_URL', '127.0.0.1:8000') }}/images/signatures/" + data['username'] + '.png';

                $.get(picPath)
                    .done(function() { 
                        document.getElementById('results').innerHTML = 
                            '<img id="imageprev" src="' + picPath + '" width="240" height="180" />';
                    }).fail(function() { 
                        // Image doesn't exist - do something else.
                        $('#results').html("");
                        $('#svg-upload-photo').removeClass('hidden');
                    });

                $.get(sigPath)
                    .done(function() { 
                        $('#signature')
                            .attr('src', sigPath)
                            .width(100)
                            .height(75);
                        $('#signature').removeClass('hidden');
                    }).fail(function() { 
                        // Image doesn't exist - do something else.

                    });

                $('#updateMember').removeClass('hidden');
                $('#cancelUpdate').removeClass('hidden');
                $('#results').removeClass('hidden');

                $('#createMember').addClass('hidden');
                $('#svg-upload-photo').addClass('hidden');
                
                $('input[name="username"]').attr('disabled', true);
                $('#qr-generator').attr('disabled', true);
            }
        );
    }

    function fillFrontCard() {
        let classification_id = $('#sel1').val();
        let firstname = $('input[name="firstname"]').val();
        let lastname = $('input[name="lastname"]').val();
        let middlename = $('input[name="middlename"]').val();
        
        let username = $('input[name="username"]').val();

        let classification = classification_id ? classification_id : 1;
        let colors = ['#333333', '#CCCCCC', '#CCCCCC'];
        let color = colors[classification - 1];
        // let color = "rgb(255, 255, 255)";
        
        // if (classification == 1) {
        //     color = "rgb(0, 0, 0)";
        // }

        let cardID = $('#card-front svg.card-id:eq(' + (classification - 1) + ')');
        cardID[0].style.fontFamily='AbelRegular';


        $('.rm-card-details', cardID).remove();

        hideSVG(classification - 1);
        // @font-face {
        //         font-family: 'AbelRegular';
        //         src: url('{{asset('css/fonts/Abel-Regular.ttf')}}')  format('truetype'); /* IE9 Compat Modes */
        //     }
        let name = document.createElementNS("http://www.w3.org/2000/svg", "text");
        name.setAttribute("font-family", 'AbelRegular');
        name.setAttribute("font-size", '42px');
        name.setAttribute("x", 359);
        name.setAttribute("y", 100);
        name.setAttribute("fill", color);
        name.setAttribute("class", 'rm-card-details');
        name.setAttribute("letter-spacing", 2);
        name.setAttribute("font-weight", "bold");
        name.innerHTML = lastname + ', ' + firstname + ' ' + middlename;

        let birthdate = document.createElementNS("http://www.w3.org/2000/svg", "text");
        birthdate.setAttribute("font-family", 'AbelRegular');
        birthdate.setAttribute("font-size", '30px');
        birthdate.setAttribute("x", 359);
        birthdate.setAttribute("y", 220);
        birthdate.setAttribute("fill", color);
        birthdate.setAttribute("class", 'rm-card-details');
        birthdate.setAttribute("letter-spacing", 2);

        let tmp = $('input[name="birthdate"]').val();
        tmp = tmp.split('/');
        let str = '';
        for (var i in tmp) {
            if (str != '') str += ' / ';
            str += tmp[i];
        }

        birthdate.innerHTML = str;

        let code = document.createElementNS("http://www.w3.org/2000/svg", "text");
        code.setAttribute("font-family", 'AbelRegular');
        code.setAttribute("font-size", '30px');
        code.setAttribute("x", 359);
        code.setAttribute("y", 269);
        code.setAttribute("fill", color);
        code.setAttribute("class", 'rm-card-details');
        code.setAttribute("letter-spacing", 2);
        code.innerHTML = username;

        let img = document.getElementById("imageprev");
        let imgsrc = img ? img.src : '';

        getDataUri(imgsrc, function(dataUri) {
            $('#member-picture', cardID).attr('xlink:href', dataUri);
            // $('#member-picture', cardID).css({
            //     width: '350px',
            //     height: '325px',
            // });
        });

        let svg = cardID[0]; //$('#member-card-front')[0];
        svg.appendChild(name);
        svg.appendChild(birthdate);
        svg.appendChild(code);
        
    }

    function fillBackCard() {
        let classification_id = $('#sel1').val();
        let username = $('input[name="username"]').val();

        let classification = classification_id ? classification_id : 1;
        let colors = ['#333333', '#CCCCCC', '#CCCCCC'];
        let color = colors[classification - 1];
        // let color = "rgb(255, 255, 255)";
        // if (classification == 1) {
        //     color = "rgb(0, 0, 0)";
        // }

        let cardID = $('#card-back svg.card-id:eq(' + (classification - 1) + ')');
        $('.rm-card-details', cardID).remove();

        cardID[0].style.fontFamily='AbelRegular';
        
        let code = document.createElementNS("http://www.w3.org/2000/svg", "text");
        code.setAttribute("font-family", 'AbelRegular');
        code.setAttribute("font-size", '42px');
        code.setAttribute("x", 446);
        code.setAttribute("y", 110);
        code.setAttribute("fill", color);
        code.setAttribute("class", 'rm-card-details');
        code.setAttribute("letter-spacing", 2);
        code.setAttribute("font-weight", "bold");
        code.innerHTML = username;

        let text1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        text1.setAttribute("font-family", 'AbelRegular');
        text1.setAttribute("font-size", '30px');
        text1.setAttribute("x", 450);
        text1.setAttribute("y", 150);
        text1.setAttribute("fill", color);
        text1.setAttribute("class", 'rm-card-details');
        text1.innerHTML = "Member account number.";

        let text2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        text2.setAttribute("font-family", 'AbelRegular');
        text2.setAttribute("font-size", '30px');
        text2.setAttribute("x", 450);
        text2.setAttribute("y", 180);
        text2.setAttribute("fill", color);
        text2.setAttribute("class", 'rm-card-details');
        text2.innerHTML = "Scan QR code to get member details.";

        let sigsrc = $('#qrcode img').attr('src');

        getDataUri(sigsrc, function(dataUri) {
            $('#member-signature', cardID).attr('xlink:href', dataUri);
            // $('#member-signature').attr('xlink:href', dataUri);
        });

        let svg = cardID[0];
        svg.appendChild(code);
        svg.appendChild(text1);
        svg.appendChild(text2);
    }

    function hideSVG(n) {
        $('#card-front svg.card-id').each(function(i) {
            if (i == n) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
        });

        $('#card-back svg.card-id').each(function(i) {
            if (i == n) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
        });
    }

    function printDiv() 
    {

        var divToPrint=document.getElementById(svgeq ? 'card-back' : 'card-front');
        // var style = '<style>@media print and (width: 8.56cm) and (height: 5.4cm) { @page {margin: 0; } }</style>';
        var style = '<style>' + g_fontAbel;
        
        style += '@media print{@page { size: 3.37in 2.127in;margin:0;} .card-id{height:206px;width:328px;margin-left:-2px;} html, body {height:100%; margin: 0 !important; padding: 0 !important;overflow: hidden;}';
        style += 'header, footer, aside, nav, form, iframe, .menu, .hero, .adslot { display: none; }}';
        style += '</style>';

        console.log(style);
        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><head>' + style + '</head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }

    function saveImage(el, fn) {
        var svgString = new XMLSerializer().serializeToString(el);

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var DOMURL = self.URL || self.webkitURL || self;
        var img = new Image();
        var svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
        var url = DOMURL.createObjectURL(svg);

        img.onload = function() {
            ctx.drawImage(img, 0, 0);
            var png = canvas.toDataURL("image/png");
            var a  = document.createElement('a');
            a.href = png;
            a.download = fn + '.png';

            a.click()
        };
        
        img.src = url;
    }
</script>
@endsection
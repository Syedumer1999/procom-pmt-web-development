@php
    use App\Models\Board;
@endphp
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('head')
<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('assets/css/style.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Navigation -->
    
    <div class="bg-dark navigation-bar">
        <div class="row container-fluid">
            <div class="col-md-2">
                <a class="navbar-brand text-white" href="#">
                    @if (Auth::check())
                    <button class="openbtn" onclick="openNav()">☰</button>
                    &nbsp;&nbsp;
                    @endif
                    PMT
                </a>
            </div>
            @if (Auth::check())
                <div class="col-md-3">
                    <form class="d-flex" style="padding: 10px 0px">
                        <input class="form-control me-2" type="search" id="searchQuery" placeholder="Search" aria-label="Search">
                        <button class="btn btn-light" type="button" onclick="getData()">Search</button>
                    </form>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-3">
                    <div class="headerAuth">
                        <div class="thumbnail">
                            {{Auth::user()->thumbnail}}
                        </div>
                        &nbsp;
                        <b class="text-white">{{Auth::user()->first_name." ".Auth::user()->last_name}} 
                            &nbsp;|&nbsp;</b>
                        <a class="text-white" href="{{url('logout')}}">Logout</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
      <!-- Navigation -->
      
        @if (Auth::check())
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <h5 class="text-white side-heading">Boards</h5>
                
                <ul>
                    @foreach (Board::getList() as $item)
                    @if (Session::get('board_id')==$item->id)
                        <li class="active"><a href="{{url('board')}}/{{$item->id}}">{{$item->name}}</a></li>
                    @else
                        <li><a href="{{url('board')}}/{{$item->id}}">{{$item->name}}</a></li>
                    @endif
                    @endforeach
                </ul>
                <center>
                <button class="btn btn-outline-light" style="width:90%" data-bs-toggle='modal' data-bs-target='#newBoard'>Add New Board</button>
                </center>
            </div>
        @endif
      <div class="container-fluid">
        <div class="main-content">
          @yield('content')
        </div>
      </div>

      <div class="modal fade" id="newBoard" tabindex="-1" aria-labelledby="newBoardLabel" aria-hidden="true" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="newBoardLabel">Add New Board</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="boardForm">
                    @csrf
                    <input type="text" name="name" id="boardName" class="form-control" placeholder="Enter Board Name"/>
                    <span class="text-danger error_msg" id="name_msg"></span>
                    <br/>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="boardTiming" tabindex="-1" aria-labelledby="boardTimingLabel" aria-hidden="true" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="boardTimingLabel">Board Updates Timing</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" value="" id="constTiming" />
            <div class="modal-body">
                <form id="boardTimingForm">
                    @csrf
                    <input type="time" name="timing" id="timing" class="form-control" />
                    <span class="text-danger error_msg" id="timing_msg"></span>
                    <br/>
                    <button type="submit" class="btn btn-success">Set Timing</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="updateTime" tabindex="-1" aria-labelledby="updateTimeLabel" aria-hidden="true" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateTimeLabel">Update Time</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" value="" id="constTiming" />
            <div class="modal-body">
                <center>
                    <h1>Update Time!</h1>
                    <h6>Please all members updates your tasks</h6>
                </center>
            </div>
          </div>
        </div>
      </div>
      
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
    }

    $("#boardForm").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          var form_data = new FormData(this);
          e.preventDefault();
                if($("#boardName").val()!=""){
                    $.ajax({
                        url: "{{url('add-board')}}",
                        type: "POST",
                        data: form_data,
                        async: false,
                        success: function (reponse) {
                                $("#boardName").val("")
                                toastr.success("Board Created Successfully");
                                location.reload();
                        },error: function (xhr) {
                            setTimeout(function(){
                                $.each(xhr.responseJSON.errors, function(key,value) {
                                    $("#"+key+"_msg").html(value);
                                    $("input[name="+key+"],textarea[name="+key+"]").addClass("error");
                                }); 
                            },1000);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
           });
    </script>
       
@yield('jsblock')
</html>
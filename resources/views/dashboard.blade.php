@extends('layout.layout')

@section('head')
    <title>Dashboard | PMT</title>
@endsection


@section('content')
@csrf
@if (Session::get('board_id')=="")
    <div class="row" style="margin-top:10%">
        <div class="col-md-4 offset-md-4">
            <center>
                <button class="btn btn-light"  data-bs-toggle='modal' data-bs-target='#newBoard' style="padding: 60px">Add New Board +</button>
            </center>
        </div>
    </div>
@else

<div class="bg-light">
            <div class="row bg-light">
                <div class="col-md-2 filter-box">
                    <small>By Filter</small>
                    <select class="form-control" id="filterLabel" onchange="getData()">
                        <option value='all'>All</option>
                    </select>
                </div>
                <div class="col-md-2 filter-box">
                    <small>By Member</small>
                    <select class="form-control" id="filterMember" onchange="getData()">
                        <option value='all'>All</option>
                    </select>
                </div>
                
                <div class="col-md-3 offset-md-5 filter-box"  style="padding: 20px 0px">
                    <a href="#" data-bs-toggle='modal' data-bs-target='#memberModal' class="text-dark" >Board Members</a>
                    &nbsp;&nbsp;
                    <a href="#" data-bs-toggle='modal' data-bs-target='#boardTiming' class="text-dark"  >Set Timing</a>
                </div>
            </div>
</div>

<div class="container-fluid list-wrap row nsortable" id="cardArea">

</div>
<!-- Modal -->
<div class="modal fade" id="addTaskModel" tabindex="-1" aria-labelledby="addTaskModelLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaskModelLabel">Add New Card</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="taskForm"> 
                @csrf
                <input type="hidden" name="list_id" id="list_id" value=""/>
                <div>
                    <label>Card Title</label>
                    <input type="text" class="form-control" name="title"/>
                    <span class="error_msg text-danger" id="title_msg"></span>
                </div>
                 <br/>
                <div>
                    <label>Card Description</label>
                    <textarea class="form-control" name="description"></textarea>
                    <span class="error_msg text-danger" id="description_msg"></span>
                </div>
                <br>
                <input type="submit" class="btn btn-success" value="Save"/>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- View Card -->
<div class="modal fade" id="ViewCard" tabindex="-1" aria-labelledby="ViewCardLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ViewCardLabel">Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 id="cardTitle"></h4>
            <p id="cardDescription"></p>
            <hr/>
            <div class="row">
                <div class="col-md-4">
                    <small>Assign Member</small>
                    <select class="form-control" id="assignMember" onchange="assignData()" name="assignMember">
                    </select>
                </div>
                <div class="col-md-4">
                    <small>Label</small>
                    <select class="form-control" id="assignLabel" onchange="assignData()"  name="assignLabel">
                    </select>
                </div>
            </div>
            <hr/>
            <div id="updatesBox">
            </div>
            <hr/>
            <form id="updateForm">
                @csrf
                <input type="hidden" id="task_id" name="task_id" value=""/>
                <textarea class="form-control" name="updateText" id="updateText" placeholder="Write Your Update"></textarea>
                <br/>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="memberModalLabel">Members</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6" id="listMembers">

                </div>
                
                <div class="col-md-6">
                    <form id="memberForm"> 
                        @csrf
                        <div>
                            <label>Add Member</label>
                            <input type="email" class="form-control" id="memberEmail" required name="email"/>
                            <span class="error_msg text-danger" id="email_msg"></span>
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-success" value="Add Member"/>
                        <br/>
                        <span id="memberError" class="text-danger"></span>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>


@endif
  @endsection


@section('jsblock')
<script src="{{url('assets/js/Sortable.js')}}"></script>
<script>
    let labelsData=[];
    let membersData=[];
    function getData(){
        board_id="{{Session::get('board_id')}}";
        $("#cardArea").html("");
        data = new FormData();
        data.append( '_token', $( 'input[name=_token]' ).val() );
        query=$("#searchQuery").val();
        filterLabel=$("#filterLabel").val();
        filterMember=$("#filterMember").val();
        $.ajax({
            url: '{{url("get-data")}}/'+board_id+'?query='+query+"&member="+filterMember+"&label="+filterLabel,
            data: data,
            processData: false,
            type: 'GET',
            success: function ( data ) {
                list=data["List"];
                $("#constTiming").val(data.set_time);
                $("#timing").val(data.set_time);
                let	opt = {
                    group: 'shared', 
                    animation:150,
                    /*onStart: (evt) => {console.log(evt.oldIndex)},*/
                    onEnd: (evt) => {
                        cardFormData = new FormData();
                        cardFormData.append( '_token', "{{ csrf_token() }}");

                        $.ajax({
                            url: '{{url("relocate")}}/'+evt.item.id+"/"+evt.to.id.replace("cardListArea_", ""),
                            data: cardFormData,
                            processData: false,
                            type: 'GET',
                            success: function ( result ) {
                                console.log(result);
                            }
                        });
                        //console.log(evt.item.id, evt.item.getAttribute('dataid'),  evt.to.id.replace("cardListArea_", ""))
                    }
                }
                for (let listing = 0; listing < data["List"].length; listing++) {
                    listHtml='<div class="list-card col-md-3">'+
                              '<div class="card">'+
                              '<div class="card-header">'+list[listing].name+'</div>'+
                              '<div class="card-body" id="cardListArea_'+list[listing].id+'"></div></div><button type="button" class="btn btn-light btn-block addTaskBtn" data-bs-toggle="modal" data-bs-target="#addTaskModel" onclick=$("#list_id").val('+list[listing].id+')>Add New Card +</button></div>';
                    $("#cardArea").append(listHtml);
                    
                    new Sortable.create(document.getElementById("cardListArea_"+list[listing].id), opt);

                    cardCount=cardList=data["ListCards"][list[listing].id];
                    for (let card = 0; card < cardCount.length; card++) {
                        cardHtml="<div class='card-data' data-bs-toggle='modal' data-bs-target='#ViewCard' onclick=dataView("+cardCount[card].id+") id='"+cardCount[card].id+"'><h5>"+cardCount[card].title+"</h5><p>"+cardCount[card].description+"</p><span class='badge bg-dark'>"+cardCount[card].labelname+"</span>"+
                            "<span class='badge bg-primary'>"+cardCount[card].username+"</span>"+
                            "</div>";
                        $("#cardListArea_"+list[listing].id).append(cardHtml);
                    }
                }
               
            }
        });
    }
    function getFieldData(){
        data = new FormData();
        data.append( '_token', $( 'input[name=_token]' ).val() );
        query=$("#searchQuery").val();
        filterLabel=$("#filterLabel").val();
        filterMember=$("#filterMember").val();
        $("#listMembers").html("");
        
        board_id="{{Session::get('board_id')}}";
        $.ajax({
            url: '{{url("get-data")}}/'+board_id+'?query=&member=all&label=all',
            data: data,
            processData: false,
            type: 'GET',
            success: function ( data ) {
                labelsData=data["labels"];
                membersData=data["BoardUser"];
                $("#assignLabel").html("<option value='un'>Un-Assign Label</option>")
                $("#filterLabel").html("<option value='all'>All</option>")
                for (let labelIndex = 0; labelIndex < labelsData.length; labelIndex++) {
                    $("#filterLabel").append("<option value='"+labelsData[labelIndex].id+"'>"+labelsData[labelIndex].name+"</option>")
                    $("#assignLabel").append("<option value='"+labelsData[labelIndex].id+"'>"+labelsData[labelIndex].name+"</option>")
                    
                }

                $("#assignMember").html("<option value='un'>Un-asssign</option>");
                $("#filterMember").html("<option value='all'>All</option>")

                for (let membersIndex = 0; membersIndex < membersData.length; membersIndex++) {
                    $("#listMembers").append("<div class='card'><div class='card-body'>"+membersData[membersIndex].first_name+" "+membersData[membersIndex].last_name+"<br/><small>"+membersData[membersIndex].email+"</small></div></div>")
                    $("#filterMember").append("<option value='"+membersData[membersIndex].id+"'>"+membersData[membersIndex].first_name+" "+membersData[membersIndex].last_name+"</option>")
                    $("#assignMember").append("<option value='"+membersData[membersIndex].id+"'>"+membersData[membersIndex].first_name+" "+membersData[membersIndex].last_name+"</option>");
                }

                
            }
        });
               
    }
    function dataView(id){
        $("#updatesBox").html("");
        data = new FormData();
        data.append( '_token', $( 'input[name=_token]' ).val() );
        $.ajax({
            url: '{{url("get-task")}}/'+id,
            data: data,
            processData: false,
            type: 'GET',
            success: function ( data ) {
                $("#task_id").val(id);
                $("#cardTitle").html(data.title)
                $("#cardDescription").html(data.description)
                $('#assignMember option:eq('+data.member_id+')').prop('selected', true)
                $('#assignLabel option:eq('+data.label_id+')').prop('selected', true)
                updates=data["updates"];
                for (let index = 0; index < updates.length; index++) {
                    html='<div class="card"><div class="card-body"><h6>'+updates[index].user+'</h6><p>'+updates[index].updateText+'</p></div> </div>';
                    $("#updatesBox").append(html);
                }
           
            }
        });
               
    }
    function assignData(){
        data = new FormData();
        $.ajax({
            url: '{{url("assign-task")}}/'+$('#task_id').val()+"/"+$( '#assignMember' ).val()+"/"+$( '#assignLabel' ).val(),
            data: data,
            processData: false,
            type: 'get',
            success: function ( data ) {
                getData();
                //getFieldData();

                updates=data["updates"];
                for (let index = 0; index < updates.length; index++) {
                    html='<div class="card"><div class="card-body"><h6>'+updates[index].user+'</h6><p>'+updates[index].updateText+'</p></div> </div>';
                    $("#updatesBox").append(html);
                }
           
            }
        });
               
    }
    $(document).ready(function(){
        
        getData();
        getFieldData();

        setInterval(() => {
            setTime=$("#constTiming").val();   
            var today = new Date();
            currentTime=('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2);
            if(setTime==currentTime){
                $("#updateTime").modal("show")
            }
        }, 30000);
        
    })

$(".addTaskBtn").click(function(){
    alert("")
    $("#list_id").val($(this).attr("data-list-id"));
})
        

</script>
<script>
    $("#taskForm").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          var form_data = new FormData(this);
          form_data.append("list_id",$("#list_id").val())
          e.preventDefault();
               $.ajax({
                   url: "{{url('add-task')}}",
                   type: "POST",
                   data: form_data,
                   async: false,
                   success: function (reponse) {
                           getData();
                           toastr.success("Card Added Successfully");
                           $("#addTaskModel").modal("hide");
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
           });

        $("#updateForm").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          var form_data = new FormData(this);
          e.preventDefault();
                if($("#updateText").val()!=""){
                    $.ajax({
                        url: "{{url('add-update')}}",
                        type: "POST",
                        data: form_data,
                        async: false,
                        success: function (reponse) {
                                $("#updateText").val("")
                                dataView($("#task_id").val())
                                toastr.success("Update Added Successfully");
                                
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
        $("#memberForm").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          $("#memberError").html("");
          var form_data = new FormData(this);
          e.preventDefault();
                    $.ajax({
                        url: "{{url('add-member')}}",
                        type: "POST",
                        data: form_data,
                        async: false,
                        success: function (reponse) {
                            if(reponse.status=="success"){
                                $("#memberEmail").val("");
                                toastr.success("Member Added Successfully");          
                                getFieldData();
                            }else{
                                $("#memberError").html(reponse.message);
                            }
                                
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
                
           });

          $("#boardTimingForm").submit(function(e) {
          $("input,textarea").removeClass("error");
          $(".error_msg").html("");
          var form_data = new FormData(this);
          e.preventDefault();
                    $.ajax({
                        url: "{{url('set-time')}}",
                        type: "POST",
                        data: form_data,
                        async: false,
                        success: function (reponse) {
                                $("#boardTiming").modal("hide");
                                toastr.success("Board Updates Time Successfully"); 
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
                
           });

           
    
</script>
@endsection
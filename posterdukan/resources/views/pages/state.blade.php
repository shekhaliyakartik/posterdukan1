@extends('layouts.app')
@section('customcss')
@endsection
@section('content')
<div class="content-wrapper">
          <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#AddState" style="float: right;">Add</button> <br><br>
         

<!-- Modal -->
<div class="modal fade" id="AddState" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 0px solid #2c2e33;">
        <h5 class="modal-title" id="exampleModalLabel">Add State</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" >
            @csrf
                <div class="form-group">
                    <label>State Name *</label>
                    <input type="text" class="form-control p_input" name="name" id="name" placeholder="Native Language...">
                    <span class="error" id="cat_error" style="display:none">State Name  is Required!</span>
                </div><br>
                <div class="form-group">
                        <label>Icon</label>
                        <input type="file" name="Icon"  id="icon" class="file-upload-default" accept="image/png, image/gif, image/jpeg">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" id="upload">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                    <span class="error" id="icon_error" style="display:none">Icon Must be Image!</span>
                </div><br>
                <div class="form-group">
                    <label>Total Population</label>
                    <input type="text" class="form-control p_input" name="total_population" id="total_population">
                </div><br>
                <div class="form-group">
                    <label>Use Population</label>
                    <input type="text" class="form-control p_input" name="use_population" id="use_population">
                </div><br>
                <div class="form-group">
                      <label>status</label>
                      <select class="js-example-basic-single" style="width:100%;height: 40px;" id="status"  name="status">
                        <option value="1">Active</option>
                        <option value="0">inActive</option>
                     </select>
                </div><br><br>
                <div class="text-right">
                    <button type="button" class="btn btn-secondary" style="height:37px;width:110px" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  style="height:37px" id="addstate">Save changes</button>
                    <button type="button" class="btn btn-primary"  style="height:37px;display:none" id="editstate">update changes</button>
                </div><br>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">State Table</h4>
                    <div class="table-responsive">
                    <table class="table table-striped" id="categorytable">
                     </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
    @section('customjs')
    <script>
        StateList();
    function StateList(){
        $.ajax({
           type:'GET',
           url:"api/getState",
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
              var record ='';
              record +=`<thead>
                            <tr>
                                <th> SrNo </th>
                                <th> Name</th>
                                <th> Icon </th>
                                <th> status </th>
                                <th> Total Population </th>
                                <th> Use Population </th>
                                <th>Action </th>
                            </tr>
                        </thead>`;
              for($i=0;$i<data.data.length;$i++)
              { 
                    if(data.data[$i]['icon'] != ""){
                    record += ` <tr>
                                    <td>${$i+1}</td>
                                    <td> ${data.data[$i]['name']}</td>
                                    <td class="py-1">
                                    <img src="/icons/${data.data[$i]['icon']}" />
                                    </td>
                                    <td> ${data.data[$i]['status']==1?"Active":"inActive"} </td>
                                    <td>${data.data[$i]['total_population']}</td>
                                    <td>${data.data[$i]['use_population']}</td>
                                    <td><button  class="badge badge-primary editbtn" data-id="${data.data[$i]['id']}">Edit</button> 
                                    <button class="badge badge-danger deletebtn" data-id="${data.data[$i]['id']}">Delete</button></td>
                                </tr>`;
                    }else{
                      record += ` <tr>
                                    <td>${$i+1}</td>
                                    <td> ${data.data[$i]['name']}</td>
                                    <td class="py-1">
                                    </td>
                                    <td> ${data.data[$i]['status']==1?"Active":"inActive"} </td>
                                    <td>${data.data[$i]['total_population']}</td>
                                    <td>${data.data[$i]['use_population']}</td>
                                    <td><button  class="badge badge-primary editbtn" data-id="${data.data[$i]['id']}">Edit</button> 
                                    <button class="badge badge-danger deletebtn" data-id="${data.data[$i]['id']}">Delete</button></td>
                                </tr>`;
                    }
              }
              $("#categorytable").html(record);
            }
        });
    }
    $(document).on('click','.add',function(){
        $("#addnative").css('display','inline');
        $("#editnative").css('display','none');
        $("#name").val('')
        $("#upload").val('');
        $("#total_population").val('');
        $("#use_population").val('');
        $('[name=status]').val('1');
    });
    $(document).on('click','#addstate',function(e){
        e.preventDefault();
        var total_population = $("#total_population").val();
        var use_population = $("#use_population").val();
        var icon = $('#icon')[0].files;

         var fd = new FormData();

         fd.append('icon',icon[0]);
         fd.append('name',$("#name").val());
         fd.append('status',$("#status").val());
         fd.append('total_population',total_population);
         fd.append('use_population',use_population);
     
        $.ajax({
           type:'POST',
           url:"api/addState",
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
              if(data.success == true){
                $("#cat_error").css('display','none');
                $('#AddState').modal('hide');
                StateList();
                
              }else{
               console.log(data.error)
               if(data.error.includes("The name field is required.")){
                $("#cat_error").css('display','block');
               }else{
                $("#cat_error").css('display','none');
               }
              
             }
            }
        });
    });
    </script>
    @endsection
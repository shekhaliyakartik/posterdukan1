@extends('layouts.app')
@section('customcss')
@endsection
@section('content')
      
          <div class="content-wrapper">
          <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#AddCategory" style="float: right;">Add</button> <br><br>
         

<!-- Modal -->
<div class="modal fade" id="AddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 0px solid #2c2e33;">
        <h5 class="modal-title" id="exampleModalLabel">Bussiness AddCategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" >
            @csrf
            <h4 class="error" id="cred_error" style="display:none">Invalid credentials</h4>
                <div class="form-group">
                    <label>CategoryName *</label>
                    <input type="text" class="form-control p_input" name="categoryname" id="categoryname" placeholder="Category Name...">
                    <span class="error" id="cat_error" style="display:none">CategoryName  is Required!</span>
                </div><br>
                <div class="form-group">
                        <label>Icon</label>
                        <input type="file" name="Icon"  id="icon" class="file-upload-default" accept="image/png, image/gif, image/jpeg">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" id="upload" >
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                    <span class="error" id="icon_error" style="display:none">Icon Must be Image!</span>
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
                    <button type="button" class="btn btn-primary"  style="height:37px" id="addCategory">Save changes</button>
                    <button type="button" class="btn btn-primary"  style="height:37px;display:none" id="editCategory">update changes</button>
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
                        <h4 class="card-title">Business Category Table</h4>
                        <!-- <p class="card-description"> Add class <code>.table-striped</code> -->
                        </p>
                        <div class="table-responsive">
                        <table class="table table-striped" id="categorytable">
                            
                            <!-- <tbody>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> Herman Beck </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $ 77.99 </td>
                                    <td> May 15, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
                                    </td>
                                    <td> Messsy Adam </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $245.30 </td>
                                    <td> July 1, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
                                    </td>
                                    <td> John Richards </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $138.00 </td>
                                    <td> Apr 12, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-4.png" alt="image" />
                                    </td>
                                    <td> Peter Meggik </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $ 77.99 </td>
                                    <td> May 15, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-1.png" alt="image" />
                                    </td>
                                    <td> Edward </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $ 160.25 </td>
                                    <td> May 03, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-2.png" alt="image" />
                                    </td>
                                    <td> John Doe </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $ 123.21 </td>
                                    <td> April 05, 2015 </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                    <img src="../../assets/images/faces-clipart/pic-3.png" alt="image" />
                                    </td>
                                    <td> Henry Tom </td>
                                    <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    </td>
                                    <td> $ 150.00 </td>
                                    <td> June 16, 2015 </td>
                                </tr>
                            </tbody> -->
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
        CategoryList();
        function CategoryList(){
        $.ajax({
           type:'GET',
           url:"api/getCategory",
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           
            success:function(data){
              var record ='';
              record +=`<thead>
                            <tr>
                                <th> SrNo </th>
                                <th>CategoryName</th>
                                <th> Icon </th>
                                <th> status </th>
                                <th>Action </th>
                            </tr>
                            </thead>`;
              for($i=0;$i<data.data.length;$i++)
              {
                    record += ` <tr>
                                    <td>${$i+1}</td>
                                    <td> ${data.data[$i]['categoryname']}</td>
                                    <td class="py-1">
                                    <img src="/icons/${data.data[$i]['icon']}" alt="image" />
                                    </td>
                                    <td> ${data.data[$i]['status']==1?"Active":"inActive"} </td>
                                    <td><button  class="badge badge-primary editbtn" data-id="${data.data[$i]['id']}">Edit</button> 
                                    <button class="badge badge-danger deletebtn" data-id="${data.data[$i]['id']}">Delete</button></td>
                                </tr>`;
              }
              $("#categorytable").html(record);
            }
        });
    }
    $(document).on('click','.add',function(){
        $("#addCategory").css('display','inline');
        $("#editCategory").css('display','none');
        $("#categoryname").val('')
        $("#upload").val('');
        $('[name=status]').val('1');
    });
    $(document).on('click','#addCategory',function(e){
        e.preventDefault();

        var icon = $('#icon')[0].files;

         var fd = new FormData();

         fd.append('icon',icon[0]);
         fd.append('categoryname',$("#categoryname").val());
         fd.append('status',$("#status").val());
     
        $.ajax({
           type:'POST',
           url:"api/addCategory",
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
                CategoryList();
                $('#AddCategory').modal('hide');
                
              }else{
               console.log(data.error)
               if(data.error.includes("The categoryname field is required.")){
                $("#cat_error").css('display','block');
               }
            //   else if(data.error.includes("The icon must be an image.")){
            //     $("#cat_error").css('display','none');
            //     $("#icon_error").css('display','block');
            //    }
              
             }
            }
        });
    });

    $(document).on('click','.deletebtn',function(e){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        if(!confirm("Do you really want to do this?")) {
        return false;
        }
        else{
    
        $.ajax(
        {
            url: "api/deleteCategory/"+id,
            type: 'post',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (){
                CategoryList();
            }
        });
        }
    });
    var id = "";
    $(document).on('click','.editbtn',function(e){
        e.preventDefault();
        id = $(this).data("id");
        $.ajax(
        {
            url: "getcategoryById",
            type: 'get',
            data: {
                "id": id,
            },
            success: function (data){
              console.log(data.data)
              $("#addCategory").css('display','none');
              $("#editCategory").css('display','inline');

              $("#categoryname").val(data.data.categoryname)
              $("#upload").val(data.data.icon);
              $('[name=status]').val(data.data.status);
              $('#AddCategory').modal('show');
            }
        });

        $(document).on('click','#editCategory',function(){
            e.preventDefault();

            var icon = $('#icon')[0].files;

            var fd = new FormData();
            // if(icon.length>0){
            //      fd.append('icon',icon[0]);
            // }
            fd.append('categoryname',$("#categoryname").val());
            fd.append('status',$("#status").val());

            $.ajax({
                url:"api/updateCategory/"+id,
                type:'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
            success:function(data)
            {
              if(data.success == true){
                $("#cat_error").css('display','none');
                $('#AddCategory').modal('hide');
                CategoryList();
              }else{
               console.log(data.error)
               if(data.error.includes("The categoryname field is required.")){
                $("#cat_error").css('display','block');
               }
             }
            }
            });
        });

    });
    </script>
    @endsection
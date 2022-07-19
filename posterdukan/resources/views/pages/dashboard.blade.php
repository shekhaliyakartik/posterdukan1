

 @include('welcome')
<div class="container mt-3">
  <h3>Dashboard</h3>
  
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
   +Add
  </button>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registration</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
        @csrf
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label for="email"><b>Email</b></label>
                <input type="text" class="form-control p_input" placeholder="Enter Email" name="email" id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password"  class="form-control p_input" placeholder="Enter Password" name="psw" id="psw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password"  class="form-control p_input" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
                <hr>

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit"  class="form-control p_input" class="registerbtn">Register</button>
            </div>

            <div class="container signin">
                <p>Already have an account? <a href="#">Sign in</a>.</p>
            </div>
         </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="register">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
       $(document).on('click','#register',function(e){
        e.preventDefault();
        var password = $("#password").val();
        var email = $("#email").val();

        $.ajax({
           type:'POST',
           url:"/register",
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         //   data:{password:password, email:email},
            success:function(data){
                console.log(data);
            }
        });
      })
</script>




@yield('customcss')
@include('layouts.stylesheet')
      
<div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>
                <form method="post" >
                @csrf
                <h4 class="error" id="cred_error" style="display:none">Invalid credentials</h4>

                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
                  <div class="form-group">
                    <label>Username or email *</label>
                    <input type="text" class="form-control p_input" name="email" id="email">
                    <span class="error" id="email_error" style="display:none">Email is Required!</span>
                  </div><br>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" class="form-control p_input"  name="password" id="password">
                    <span class="error" id="password_error" style="display:none">Password is Required!</span>
                  </div><br>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me <i class="input-helper"></i></label>
                    </div>
                    <a href="#" class="forgot-pass">Forgot password</a>
                  </div><Br>
                  <div class="text-center">
                    <button  id="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div><br>
                  <div class="d-flex">
                    <!-- <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button> -->
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).on('click','#login',function(e){
        e.preventDefault();
        var password = $("#password").val();
        var email = $("#email").val();

        $.ajax({
           type:'POST',
           url:"api/login",
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{password:password, email:email},
            success:function(data){
              if(data.success == true){
                location.href = '{{ url("dashboard") }}'
              }else{
               console.log(data.error)
               if(data.error.includes("The email field is required.")){
                $("#email_error").css('display','block');
               }
              else if(data.error.includes("The email must be a valid email address.")){
                $("#email_error").html('Invalid Email!');
               }
               else if(data.error.includes("The password field is required.")){
                $("#email_error").css('display','none');
                $("#password_error").css('display','block');

               }
              else if(data.error.includes("invalid credentials")){
                $("#email_error").css('display','none');
                $("#password_error").css('display','none');
                $("#cred_error").css('display','block');
              }
            }
            }
        });
      });
    </script>
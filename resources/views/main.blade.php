@include('header')
@yield('main-container')

<div id="home">
<img src="images/hero.jpg" class="img-fluid" alt="Hero Image" />
<div class="py-3" style="background-color: rgb(7, 23, 51)">
  <div class="container text-center text-white px-5">
    <p class="fs-4">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
      eiusmod tempor incididunt ut labore et dolore magna aliqua. At
      consectetur lorem donec massa sapien. Posuere urna nec tincidunt
      praesent semper feugiat nibh sed pulvinar
    </p>
  </div>
</div>
</div>

<div id="services">
<div class="container text-center py-lg-3">
  <h2 class="underline">SERVICES</h2>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="card shadow">
        <div class="card-body p-5">
            
            <i class="fa-solid fa-handshake icon-style"></i>
          <h5 class="card-title" style="font-weight: 700">
            BUSINESS SETUP
          </h5>
          <p class="card-text">
            Get a full range of business setup solutions from the regions
            finest business setup experts...
          </p>
          <a href="#" class="btn btn-sm rounded-pill border-0 button-style">LEARN MORE</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card shadow">
        <div class="card-body p-5">
            <i class="fa-solid fa-money-bills icon-style"></i>
          <h5 class="card-title" style="font-weight: 700">BANKING</h5>
          <p class="card-text">
            Enhance your business with a wide range of financial assistance
            at your fingertips. Services...
          </p>
          <a href="#" class="btn btn-sm rounded-pill border-0 button-style">LEARN MORE</a>
        </div>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="card shadow card-color">
        <div class="card-body text-white p-5">
            <i class="fa-solid fa-newspaper icon-style"></i>
          <h5 class="card-title" style="font-weight: 700">INSURANCE</h5>
          <p class="card-text">
            Compare the best insurance deals from a wide range of options.
            Get home, health, business,...
          </p>
          <a href="#" class="btn btn-sm rounded-pill border-0 button-style">LEARN MORE</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<div class="container-fluid" id="contact">
  <div class="row pt-5">
    <div class="col-md-6">
      <img src="images/image2.jpg" class="img-fluid side" alt="Hero Image" />
    </div>
    <div class="col-md-5">
      <div class="h2" style="font-weight: 900">CONTACT US</div>
     <form id="contact-frm" class="row justify-content-center py-lg-3 py-xl-4" action="{{ route('contact-form.store') }}">
       

        <input type="hidden" id="token" value="{{ @csrf_token() }}">
        
      
        <div class="mb-3">
          <label for="fullname" class="form-label" style="font-weight: 700">Full Name</label>
          <input type="text" id="name" name="name" class="form-control input-field" required/>
        </div>
        <div class="mb-3">
          <label for="mobilenumber" class="form-label" style="font-weight: 700">Mobile</label>
          <input type="number" id="mobile" name="mobile" class="form-control input-field" required/>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label" style="font-weight: 700">Email</label>
          <input type="email" id="email" name="email" class="form-control input-field" required/>
        </div>
        
        
        <button type="submit" id="btn" class="btn btn-lg rounded-pill border-0 form-button">SUBMIT</button>
        
        
      </form>
      <div id="res"></div>
    </div>
  </div>
</div>

</body>
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        $(document).ready(function(){
            $("#contact-frm").submit(function(e){
                e.preventDefault();
                let url = $(this).attr('action');
                // alert(url);
                $("#btn").attr('disabled', true);
                $.post(url, 
                {
                    '_token': $("#token").val(),
                    name: $("#name").val(),
                    mobile: $("#mobile").val(),
                    email: $("#email").val()
                }, 
                function (response) {
                    if(response.code == 400){
                        $("form").trigger("reset");
                        $("#btn").attr('disabled', false);
                         let error = '<div class="text-center alert alert-danger">'+response.msg+'</div>';
                        $("#res").html(error);
                    }
                    else if(response.code == 200){
                        $("form").trigger("reset");
                        $("#btn").attr('disabled', false);
                        let success = '<div class="text-center alert alert-success">'+response.msg+'</div>';
                        $("#res").html(success);
                    }
                });
                })
           })
    </script>
     </html>
@include('footer')
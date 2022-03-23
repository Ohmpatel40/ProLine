<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
          <h4 class="font-weight-bolder text-white mb-0">Vidyabhati Trust Collage of BBA and BCA</h4>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex align-items-center" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <button type="button" class="btn" id = "search" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: white;"> <i class="fas fa-search" aria-hidden="true"></i> </button>
          </div>
          <div class="navbar-nav  justify-content-end">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign Out</span>
              </a>
          </div>
        </div>
      </div>
</nav>
<script>
      $(document).ready(function(){
        $("#search").click(function(){
          console.log("CLICKED");
          var data =  $("#searchSID").load("UIDContainer.php");
				  setInterval(function() {
					  $("#searchSID").load("UIDContainer.php");
            var value = $("#searchSID").val();
            if(value.length > 0)
            {
              window.location.href = "fulldetails.php?SID=" + value;
            }
				  }, 500);
        });
        $("#redirect").click(function(){
          var sid = $("#maunallySID").val();
          window.location.href = "fulldetails.php?SID=" + sid;
        })
			});
  </script>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search By Smart Card</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center flex-column">
          <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_cdm7ig5v.json"  background="transparent"  speed="1.5"  style="width: 250px; height: 250px;"  loop  autoplay></lottie-player>
          <h6 class="font-weight-bolder mb-0">Tap card on scanner to search!</h6>
          <form>
            <textarea class="form-control" id="searchSID" style="display:none;" required></textarea>
          </form>
      </div>
      <div class="modal-footer d-flex justify-content-center flex-column">
        <button  class="btn btn-primary"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" > Search Manually </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Search Manually</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form>
            <input type="text" class="form-control"  id="maunallySID"  placeholder="Enter SID" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="redirect" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>
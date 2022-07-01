  <!-- Site footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="row justify-content-between ">
        <!--justify-content-between -->
        <div class="col-sm-12 col-md-2">
          <img src="/img/logo.jpg" width="100%" class="mb-2" alt="FOT BLOG">
          <hr>
          <h6 class="mt-1">About</h6>
          <p class="text-justify">Faculty of Technology,<br>
            University of Colombo,<br>
            Mahenwatta, Pitipana,<br>
            Homagama,<br>
            Sri Lanka<br><br>
            Telephone: Dean +94112078607<br>
            Email: dean@tec.cmb.ac.lk<br>
            Asst. Registrar +94112078171</p>
        </div>

        <div class="col-sm-12 col-md-4">
          <form action="{{route('search')}}" method="get">
            <div class="input-group">
              <div class="form-outline d-flex">
                <input id="search-input" type="search" id="form1" class="form-control" name="q" placeholder="Search blogs" required maxlength="20" />
                <button id="search-button" type="submit" class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-xs-6 col-md-2">
          <h6>Quick Links</h6>
          <ul class="footer-links">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('pages', 'Techno Media')}}">Techno Media</a></li>
            <li><a href="{{route('pages', 'Media')}}">Media</a></li>
            <li><a href="{{route('pages', 'Sports')}}">Sports</a></li>
            <li><a href="{{route('pages', 'Sports')}}">Alumini</a></li>
            <br>
            <li><a target="_blank" href="{{route('login')}}">Admin Login</a></li>
          </ul>
        </div>
      </div>
      <hr>
    </div>

    <div class="container">
      <div class="row justify-content-end">

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
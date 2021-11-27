<!DOCTYPE html>
<html lang="en">
@include('template.applicant.segments.header')
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('template.applicant.segments.navbar')

    <div class="content-wrapper">
      <div class="container-fluid">
<!-- chart -->
<br>
        <!-- Icon Cards -->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fa fa-fw fa-user"></i>
                </div>
                <div class="mr-5">
                  Update Resume
                </div>
              </div>
              <a href="#" class="card-footer text-white clearfix small z-1">
                <span class="float-left">View Resume</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

<div class="card-header small text-muted">
  <i class="fa fa-alert"></i>
  Application status : 
</div>
<br>
<button class="btn btn-sm btn-info" data-toggle="modal" data-target="#career_profile">Add/Edit Application description</button>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    
  @include('template.applicant.segments.footer')
  <script>

  </script>

  </body>

</html>

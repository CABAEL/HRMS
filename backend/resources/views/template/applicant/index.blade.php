<!DOCTYPE html>
<html lang="en">
@include('template.applicant.segments.header')
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('template.applicant.segments.navbar')

    <div class="content-wrapper">
      <div class="container-fluid">
<!-- chart -->


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

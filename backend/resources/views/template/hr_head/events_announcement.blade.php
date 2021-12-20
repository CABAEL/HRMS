<!DOCTYPE html>
<html lang="en">
@include('template.hr_head.segments.header')
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
  @include('template.hr_head.segments.navbar')

    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-6 col-sm-6 mb-6">
            <button class="btn btn-sm">Add Events</button>
            <div class="" id="events_cont"></div>
          </div>
          <div class="col-xl-6 col-sm-6 mb-6">
            <button class="btn btn-sm">Add Announcement</button>
            <div class="" id="announcement_cont"></div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
  @include('template.hr_head.segments.footer')
  <script src="{{ asset('js/custom/page/hr_head/job_vacancy.js') }}"></script>
  </body>

</html>

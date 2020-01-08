<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MEDICO...Your Dream. Our Team.</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="{!!asset('css/bootstrap.min.css')!!}">
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap-notifications.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/admin.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/admin-skins.css')}}">
  <link rel="stylesheet" href="{{asset('summernote/summernote.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
  @yield('style')
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body class="sidebar-mini skin-blue-light">
<div class="wrapper">
  @include('admin.master.header')
  @include('admin.master.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Developed By- </b> <a href="https:///fb.com/romi.mitu" target="_blank">RoMi</a>
    </div>
    <strong>Copyright &copy; 2019.</strong> All rights reserved.
  </footer>

</div>
<!-- jQuery 3 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/js/pusher.min.js')}}"></script>
<script src="{{asset('admin/js/admin.min.js')}}"></script>
<script src="{{asset('summernote/summernote.min.js')}}"></script>
<script>
  $(document).ready(function () {
      $('textarea').summernote({
          height: 100,
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['fontsize', ['fontsize', 'fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              //['Insert', ['picture', 'link', 'table']],
          ]
      });
  });

  $(function () {
      $(".datepicker").datepicker({
          changeYear: true,
          changeMonth: true,
          yearRange: '2000:2050',
          dateFormat: 'yy-mm-dd'
      }).datepicker("setDate", new Date());
  });
  function sumColumnValue(index) {
        var total = 0;
        $("table #tbody td:nth-child(" + index + ")").each(function () {
            total += parseFloat($(this).find('input').val(), 10) || 0;
        });
        return total.toFixed(0);
    }
</script>
@yield('script')
<script>
  $("#flowcheckall").click(function () {
    $(this).closest('div').find('.name').prop('checked', this.checked);
  });
  $( document ).ready(function() {

    var url = window.location.href;
    console.log(url);
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href != url;
    }).parent().removeClass('active');

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
  });
</script>


<script type="text/javascript">
      var notificationsCount     = parseInt($('.notify-count').text());
      var notifications          = $('.notifications-menu').find('ul.notify-area');
      var pusher = new Pusher('0de028724d318fb9f0a8', {
        cluster: 'ap2',
        forceTLS: true
      });

      // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('new-order');

      // Bind a function to a Event (the full Laravel class)
      channel.bind('App\\Events\\NewOrder', function(data) {
        var newNotificationHtml = `
          <li><a href="#"><i class="fa fa-shopping-cart text-green"></i>`+data.message+`</a></li>
        `;
        notifications.append(newNotificationHtml);
        notificationsCount += 1;
        $('.notify-count').text(notificationsCount);
      });
    </script>
</body>
</html>

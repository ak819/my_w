<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@if (trim($__env->yieldContent('title')))
        @yield('title')
       @else Welcome to Homes Jordan @endif </title>
    <!--<link href="../css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--External Fonts Start-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" rel="stylesheet" />
    
    
    <link rel="apple-touch-icon" sizes="180x180" href="http://beta.homes-jordan.com/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://beta.homes-jordan.com/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://beta.homes-jordan.com/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="http://beta.homes-jordan.com/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="http://beta.homes-jordan.com/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    
    <!--External Fonts End-->
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('summernote/summernote-bs4.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--<script src="assets/js/appath.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    
    <script src="{{asset('summernote/summernote-bs4.js')}}"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   

</head>
<!--/head-->

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <span class="navbar-logo">
                <a href="{{ route('admin') }}">
                    <img src="{{asset('images/logo.png')}}" alt="logo" width="150px">
                </a>
            </span>
            <br /><br /><br /><br />
            @if (Auth::user()->roleid==1)
            @include('admin-layouts.super-admin-menu');
            @elseif (Auth::user()->roleid==2)
            @include('admin-layouts.admin-agent-menu');
            @elseif (Auth::user()->roleid==3)
            @include('admin-layouts.property-agent-menu');
            @elseif (Auth::user()->roleid==4)
            @include('admin-layouts.digital-agent-menu');
            @else
            <ul class="list-unstyled components">
                <li class="nav-item active"><i class="material-icons font-size-20 color-gold">dashboard</i>&nbsp;&nbsp;<span>No Options</span></li>
               
            </ul>
            @endif
        </nav>
        <!-- Page Content Holder -->
        <div class="content gray">
            <nav class="navbar navbar-expand-lg white navbar-light gold">
                <!--<a class="navbar-brand" href="#">Navbar</a>-->
                <div class="navbar-header">
                    <button class="btn btn-gold-lt btn-small navbar-btn" type="button" id="sidebarCollapse">
                        <i class="material-icons icon-2x color-red1">
                            menu
                        </i>
                    </button>
                </div>
                <button class="navbar-toggler btn btn-orange-lt btn-small" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="material-icons">
                        more_vert
                    </i>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                 
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle color-white" data-toggle="dropdown" data-hover="dropdown" data-delay="50" data-close-others="true">
                                Hi, {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <a class="dropdown-item" href="{{ route('changepassword') }}">Change Password</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <!--<script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            $('#datatable').dataTable({
                "order": []
            });
              
                var table=$('#ExportDatatable').DataTable({
            "order": [],
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10 rows', '25 rows', '50 rows', '100 rows', 'Show All']
            ],
            buttons: [
                'pageLength',
                {extend: 'excelHtml5',"exportOptions": {columns: '.show_excel'}}
                ],


            });
           
            $('.selectto').select2();
        });
//// get location by city
    $(".city").change(function(){
    var cityid=$(this).val();
    $.ajax({
            url:'{{route('locationlist')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",cityid:cityid,lang:"en"},
            success: function(response){
                if(response)
                { 
                    $(".locationlist").empty();
                    var optionsAsString = "";
                    $.each(response.locations, function (key, value) {
                    optionsAsString += "<option value='" + value.id + "'>" + value.CommunityName + "</option>";
                    });
                    //$('<option value="">Select Multiple Location</option>').appendTo('.locationlist');
                $('.locationlist').append( optionsAsString );
                 $('.locationlist').select2({
                 pagination: {more: true}
                 });
                

                }
            }

      });
});
////
    $('.delete').click(function () {
   
   var box=confirm('Are you sure, you want to delete ?');
 if (box==true)
          return true;
      else
         return false;
        
      
  });
    $('.reset').click(function () {
   
   var box=confirm('Do you want to reset status of all properties ?');
 if (box==true)
          return true;
      else
         return false;
        
      
  });
    </script>
    <script type="text/javascript">
        $(function() {
            $('.datetimepicker').datetimepicker();
        });
    </script>
    <script>
        // tinymce.init({
        //     selector: 'textarea.description',
        //     height: 500,
        //     menubar: false,
        //     plugins: [
        //         'advlist autolink lists link image charmap print preview anchor',
        //         'searchreplace visualblocks code fullscreen',
        //         'insertdatetime media table paste code help wordcount'
        //     ],
        //     toolbar: 'undo redo | formatselect | ' +
        //         'bold italic backcolor | alignleft aligncenter ' +
        //         'alignright alignjustify | bullist numlist outdent indent | ' +
        //         'removeformat | help',
        //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        // });

     

        function readImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        function showMoreDescrition() {
    var fullText = document.getElementById("full-desc");
    var halfText = document.getElementById("half-desc");
    var btnText = document.getElementById("myBtn");

    if (fullText.style.display === "none") {
        btnText.innerHTML = "Read Less";
        halfText.style.display = "none";
        fullText.style.display="inline"
    } else {
        fullText.style.display = "none";
        btnText.innerHTML = "Read More";
        halfText.style.display = "inline";
    }
    }
    </script>
</body>

</html>
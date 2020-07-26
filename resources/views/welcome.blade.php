<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Aphix</title>

       
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
    
        <!-- Styles -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
   
    <body>
         <div class = "container">
            <div class = "row">
                <div class = "col-lg-6">   
                    <form id="keywordForm" method="post" action="">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="keyword" placeholder="Search" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><span class="fas fa-search"></span></button>
                            </div>
                        </div>  
                        
                    </form>
                </div>
            </div>
            <br><br>
            <div id="search-result"></div>
        </div>
             
    </body>
    <script type="text/javascript">
        $('#keywordForm').on('submit',function(event){
            event.preventDefault();
             keyword = $('#keyword').val();
             $.ajax({
                cache: false,
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, 
                type:'GET',
                url: '/getYoutubeApi/{' + keyword + '}',
                data:'_token = <?php echo csrf_token() ?>',
                success: function( data ){
                    videoList = "";
                    $.each(data.items, function(index, e) {
                    videoList = videoList + 
                                '<div class = "flex-container"><div>' +
                                '<a href="//www.youtube.com/embed/'+e.id.videoId+'" target="_blank"><img class= "img-thumbnail" style="min-width:200px" alt="' + e.snippet.title + '" src="' + e.snippet.thumbnails.default.url + '">'+
                                '</div><div style="flex-grow: 8"><p><b><h2>' +e.snippet.title+'</b></h2><h5>' 
                                 +e.snippet.description+'</h5></p></div></a>' +
                                '</div>';
                    });
                    $('#search-result').html(videoList);
                    console.log(data);
                }
            });
         });
    </script>
</html>
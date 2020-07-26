<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
       
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        

    </head>
    <body>
        <div class = "container">
            <div class="search-form-container">
                    <form id="keywordForm" method="post" action="">
                        <div class="input-row">
                            <input class="input-field" type="search" id="keyword" name="keyword"  placeholder="Search YouTube videos.">
                        </div>

                        <button class="btn btn-success" id="submit">Search</button>
                    </form>
            </div>
            <div class = "row">
                <div id="search-result"></div>
            </div>
        </div>

   
    </body>
    <script type="text/javascript">
        $('#keywordForm').on('submit',function(event){
            event.preventDefault();

            keyword = $('#keyword').val();
          
            $.ajax({
            //    cache: false,
                
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
                                '<div class = "col-lg-12">' +
                                '<a href=""><img class= "img-thumbnail" alt="' + e.snippet.title + '" src="' + e.snippet.thumbnails.default.url + '"></a>'+
                                '<h2>' +e.snippet.title+'</h2>' + 
                                '<p>' +e.snippet.description+'</p>' +
                                '</div>';
                });
                    $('#search-result').html(videoList);
                    console.log(data);
                }
            });
         });
    </script>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="<?= $this->url->get('img/favicon.ico') ?>?>"/>
    </head>
    <style>

        /*.my-start-stop span.active{
            display: block;
        }
        .my-start-stop span{
            display: none;
        }*/
    </style>
    <body>
        <div class="main-first-content-live">
            <?= $this->getContent() ?>
        </div>
        <!-- jQuery first, then Popper.js, and then Bootstrap's JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>

            /*$('.my-start-stop').on('click', function(e){



                e.preventDefault();

                $.ajax({
                    url: "demo_test.txt",
                    type: 'GET',
                    success: function(result){

                    }});

                if($('span.str').hasClass("active")){
                    $('span').removeClass('active');
                    $('span.end').addClass('active');
                }else{
                    $('span.str').addClass('active');
                    $('span.end').removeClass('active');
                }

            });

            $("#search").click(function() {
                $('span').addClass('active');
            });


            $(".my-buttom-active").click(function() {
                $("span").removeClass('active');
            });

            $('#about-link').addClass('current');
            $('#menu li').on('click', function() {
                $(this).addClass('current').siblings().removeClass('current');
            });*/

        </script>
    </body>
</html>

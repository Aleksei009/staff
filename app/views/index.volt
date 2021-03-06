<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/favicon.ico') }}?>"/>
    </head>
    <style>

        /*.my-start-stop span.active{
            display: block;
        }
        .my-start-stop span{
            display: none;
        }*/

        .styleA a{
            padding: 5px 10px;
            color: black;
            text-decoration: none;
        }
        .hide-show-block{
            display: none;
        }
        .hide-show-block.active{
            display: table-row;
        }

        .active-important{
            display: table-row !important;
        }

        .left{
            float: left;
        }
        .infom{
            width: 400px;
        }
        .float-left-need{
            float: left; width: 805px;
        }
        .users{
            display: flex;
        }
        .users .user{
            padding: 0 10px;
        }
        .users .user .img img{
            height:50px;width: 50px;
        }
        .menu-option{
            display: flex; justify-content: center; margin-bottom: 25px;
        }
        .float-right-need{
            float: right;width: 300px;
        }
        .button{
            text-align: center; font-weight: bold; border:1px solid #c1b5b5;font-size: 18px;
        }
        .week-now{
            text-align: center;font-size: 16px;font-weight: normal;border: 1px solid #a7a6a6;
        }
        .total-fail{
            color: red; font-weight: bold;
        }
        .total-success{
            color: green; font-weight: bold;
        }
    </style>
    <body>
        <div class="main-first-content-live">
            {{ content() }}
        </div>
        <!-- jQuery first, then Popper.js, and then Bootstrap's JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script>

            $(".hide-show").on('click',function () {

                $(".hide-show-block").toggleClass('active')
            })
        </script>
    </body>
</html>

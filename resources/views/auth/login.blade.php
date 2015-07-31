<!DOCTYPE html>
<html>
    <head>
        <title>Pantheon: Welcome</title>

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
                 font-family: Helvetica Neue, Arial;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
            }

            .container {
                position: absolute;
                width: 100%;
                height: 100%;
                margin-top: auto;
                text-align: center;
                vertical-align: middle;
                color: #ffffff;
                z-index:3;
            }

            .content {
                
                line-height: 110%;
                background-color: rgba(111,111,111, 0.9);
                position: absolute;
                top: 50%;
                left: 50%;
                margin-top: -215px;
                margin-left: -175px;
                width: 350px;
                height: 430px;
                text-align: center;
                display: inline-block;
                border-radius: 8px;
            }

            .title {
                font-size: 40px;
                margin-bottom: 15px;
                font-weight: 600;
                font-family: 'Josefin Sans', sans-serif;
            }

            .quote {
                font-size: 20px;
                color: rgba(211,211,211, 1);
                font-weight: 300;
                font-family: 'Josefin Sans', sans-serif;
            }
            #Backimg{
                /*
                background-size: cover;
                background-position: center;
                */
                position: fixed;
                width: 100%;
                height: 100%;
                z-index:0;
            }
            #BackimgDark{
                background-color: rgba(1,1,1, 0.5);
                position: fixed;
                width: 100%;
                height: 100%;
                z-index:1;
            }
            
            input {
               border: 1px solid rgba(151,151,151, 0.9); 
               -webkit-box-shadow: 
                   inset 0 0 8px  rgba(0,0,0,0.1),
                   0 0 16px rgba(0,0,0,0.1); 
                -moz-box-shadow: 
                        inset 0 0 8px  rgba(0,0,0,0.1),
                        0 0 16px rgba(0,0,0,0.1); 
                box-shadow: 
                    inset 0 0 8px  rgba(0,0,0,0.1),
                    0 0 16px rgba(0,0,0,0.1); 
                padding: 8px 8px;
                background: rgba(255,255,255,0.9);
                min-width: 288px;
                font-size: 110%;
                margin: 0px 5px;
                border-radius: 8px;
                color: rgba(88,88,88, 0.8);
            }
            button {
                border-radius: 8px;
                font-weight: bold;
                font-size: 150%;
                text-transform: uppercase;
            }
             button {
                 color: rgba(228,228,228, 0.8);
                 padding: 5px 5px;
                 font-size: 90%;
                 margin: 5px 5px;
                 background: rgba(88,88,88, 0.8);
                 border-radius: 8px;
                 border-style:solid;
                 border-color: rgba(88,88,88, 0.0);
                 text-transform: uppercase;
                 -webkit-transition:0.2s;
                 -moz-transition:0.2s;
                 -o-transition:0.2s;
                 transition:0.2s;
            }
            button:hover {
                background: rgba(38,38,38, 0.9);
                padding: 5px 6px;
                color: rgba(288,288,288, 1);
                border-radius: 7px;
            }
            a{
                padding: 3px 3px;
              color: rgba(288,288,288, 0.8);
                text-decoration:none;
                -webkit-transition:0.2s;
                 -moz-transition:0.2s;
                 -o-transition:0.2s;
                 transition:0.2s;
            }
            a:hover{
                background-color: rgba(1,1,1, 0.2);
                border-radius: 5px;
              color: rgba(288,288,288, 1);
                text-decoration:none;
            }
        </style>
    </head>
    <body>
        <div id="Backimg"></div>
         <div id="BackimgDark"></div>
        <div class="container">
            <div class="content">
                <p><img src="http://mypanteon.com/logo.png" width=110px style="margin: 5px 5px;"></p>
                <p><div class="title">myPantheon</div></p>
            <p><div class="quote">Religion of the new age</div></p>
        <br/>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}"></p>
            <p><input type="hidden" name="_token" value="{{ csrf_token() }}"></p>
            <p><input type="email" class="form-control" name="email" placeholder="User Email" value="{{ old('email') }}"></p>
            <p><input type="password" class="form-control" name="password" placeholder="Password"></p>
            <p><input type="checkbox" name="remember"> Remember Me</p>
            <p style="font-size: 80%;">Have no account? <a style="font-size: 140%;" href="/auth/register">Register!</a></p>
            <p><button type="submit" class="btn btn-primary">Login</button></p>
            
							
        </form>
        
        
        </div>
    </div>
</body>
</html>
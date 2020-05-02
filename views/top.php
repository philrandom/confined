<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/views/style/top.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>
            
            $(document).ready(function()
            {
                $(".button-div").click(function()
                {
                    //si le menu de connexion n'est pas affiché, on l'affiche
                    if(document.getElementById("user-pannel").innerHTML == '')
                    {
                        $.ajaxSetup({cache: false});
                        $.get('/assets/ajax/getsession.php',function(data){
                            cocheck(data);
                        });
                        function cocheck(user){
                            $("#user-pannel").addClass("user-pannel-active");
                            if(user == '')
                            {
                                document.getElementById("user-pannel").innerHTML = "<div id=\"connect\"><div class=\"lien\"><a href='/login/' class='lien-1'>Log in</a></div><div class=\"lien\"><a href='/register/' class='lien-2'>I'm new</a></div></div>";
                            }
                            else
                            {
                                document.getElementById("user-pannel").innerHTML = "<div id=\"name-container\"><p id=\"name\" style=\"color:#444444\">"+user+"</p></div><div id=\"myaccount\"><a id=\"lien-compte\" href=\"/dashboard/\"><NOBR>See my Account</NOBR></a></div><div id=\"disconnect\"><div id=\"door\" style=\"background-color: #444444;\"><div id=\"door-container\"><a href=\"/disconnect/\"><img src=\"/assets/icons/door.png\"></a></div></div></div>";
                            }
                        }
                    }
                    //si il est affiché, on le ferme quand on clique sur le bouton
                    else
                    {
                        document.getElementById("user-pannel").innerHTML = '';
                    }
                });
                //redimensionnages 
                var cw = $('#door').width();
                $('#door').css({'margin-top: 5%;margin-bottom: 5%;border-radius: 50%;width:30%;display:flex;justify-content: center;align-items: center;height':cw+'px'});
            });
            
        </script>
    </head>

    

    <body>

        <!-- bar indicator -->
        <div class="bar" style="background-color: #444444;"></div>

        <!-- User button -->
        <div id="user">
            <div class="button-div">
                <button style="background-color: #444444;" class="rond btn"><img src="/assets/icons/iconLogin3.png" style="height:100%; width:100%; display: block;  margin: auto;"></img></button>
            </div>
            <div id="user-pannel"></div>
        </div>
        
        <a href="/"><img src="/assets/icons/logo.png" class="logo"></img></a>

    </body>
    
</html>

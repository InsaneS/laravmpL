
<!DOCKTYPE html>
<html>
    <head>
        <title>MyPantheon</title>
        <link rel="stylesheet" type="text/css" href="/css/dropzone.css" />
        <link rel="stylesheet" type="text/css" href="/css/Style.css" />
        <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="/js/jquery.ac.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>
        <script src="/js/Chart.js"></script>
        <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css"> 
        <script src="/js/jquery.tagsinput.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/jquery.tagsinput.css" />
 
    </head>
     <body>   
            <!--style="background-image: url(/Back_s/Back2.png)"-->
         <div id="Backgr"></div>
         <div id="WhiteL" onclick="CloseAlertWindow()"></div>
         
     
        <div id="AlertWindow" class="newWindow" style="height:300px; width:340px"> 
            <h2><p id="AlertName" style="color: rgba(52,51,49,0.9);">Yo</p></h2>
                       
            <hr class="basicDividerlight"/>
                 <br/>
                 <p id="Alerteditplace"><input type="text" id="AlertInput" placeholder="Something"></input></p>  
                <p id="AlertSupportText" class="suporttext2">Support text</p>  <br/>
                <hr class="basicDividerlight"/>
                <p id="Alerteditplace1"></p> 
                
                </div>
    
    <div id='CreatePost' class="newWindow" style="height:580px; maigin-top:-300px; width:500px;">

        <p class="headertext2" style="padding: 5px">Create new post!</p>
        <hr class="basicDividerlight"/>
        
        
        
        {!! Form::open(['route' => 'post.store', 'files' => true]) !!}
        
        <p  style="margin:10px 10px;"><a href="javascript: chPostImUrl()" id="selectBt">Image from url</a>&nbsp;&nbsp;<a href="javascript: chPostImPC()" id="selectBt">Image from computer</a></p>
        
        <p style="align-content: center;"><a id="urlform">{!! Form::text('urlIMG', null, ['class'=>'form-control', 'id' => 'urlForm1', 'placeholder' => 'Your Image URL']) !!}</a><a id="fileform">{!! Form::file('yourIMG', ['class'=>'form-control']) !!}</a></p>
        <br/>
        <p>{!! Form::label('Waifus in art') !!}<br/><p  style="margin-left:18%;">{!! Form::text('Waifus', null, ['class'=>'form-control', 'id'=>'Waifus']) !!}</p></p>
        <br/>
        <p>{!! Form::label('Tags') !!}<br/><p  style="margin-left:18%;">{!! Form::text('Tags', null, ['class'=>'form-control', 'id'=>'Tags']) !!}</p></p>
        <br/>
        <p>{!! Form::label('Url to original') !!}{!! Form::text('original', null, ['class'=>'form-control']) !!}</p>
        
        <p>{!! Form::label('publishDate') !!} {!! Form::input('date', 'publishDate', date('Y-m-d'), null, ['class'=>'form-control']) !!}</p>
        
        


        <script>
            function getWaifustags(){
                var url1 = '/database/getwaifutags/';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Waifus').tagsInput({
                           autocomplete_url:data,
                           availableTags: data,
                           fieldName: "Waifu Tags",
                       });
                
                }});
            }
            function getHashtags(){
                var url1 = '/database/gethashtags/1';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Tags').tagsInput({
                           autocomplete_url:data,
                           fieldName: "Hashtags",
                       });
                
                }});
            }
            getHashtags();
            getWaifustags();
            function chPostImPC(){
                document.getElementById("urlForm1").value = "";
                document.getElementById("urlform").style.display="none";
                document.getElementById("fileform").style.display="block";
            }
        
            function chPostImUrl(){
                
                document.getElementById("urlform").style.display="block";
                document.getElementById("fileform").style.display="none";
            }
        </script>
            
        
        
        <hr class="basicDividerlight"/>
        
<p><button type="submit"  class="btn btn-primary">Submit</button></p>
        {!! Form::close() !!}

    </div>


         <script>
             
             //////////////////////___FUNCTIONS___
             
             function ShowCreatePost(){
                 $("#WhiteL").fadeIn(200);
                 $("#CreatePost").fadeIn(200);
                 getWaifustags();
             }
             
             function ShowAlertWindow(newAlertName, newAlertSupportText, newPlaceholder, functionname, place){
            
                 document.getElementById("AlertName").innerHTML = newAlertName;
                 document.getElementById("Alerteditplace").innerHTML = '<input type="text" id="AlertInput" placeholder="Something">';
                 document.getElementById("AlertSupportText").innerHTML = newAlertSupportText;
                 document.getElementById("AlertInput").value = "";
                 document.getElementById("AlertInput").placeholder = newPlaceholder;
                 document.getElementById("Alerteditplace1").innerHTML = '<button type="button" id="AlertButton" onclick="editwaifu(\''+place+'\')" class="btn btn-primary">Submit</button>';
                 $("#WhiteL").fadeIn(200);
                 $("#AlertWindow").fadeIn(200);
             }
             
             function ShowAlertWindowinPost(newAlertName, newAlertSupportText, functionname, place, PostId){
                 document.getElementById("AlertName").innerHTML = newAlertName;
                 document.getElementById("Alerteditplace").innerHTML = '<input type="text" id="Waifus1">';
                 document.getElementById("AlertSupportText").innerHTML = newAlertSupportText;
                 document.getElementById("Waifus1").value = place;
                 if(functionname == 'editpostW'){
                 var url1 = '/database/getwaifutags/';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Waifus1').tagsInput({
                           autocomplete_url:data,
                       });
                
                }});
                 }
                 if(functionname == 'editpostH'){
                 var url1 = '/database/gethashtags/1';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Waifus1').tagsInput({
                           autocomplete_url:data,
                       });
                
                }});
                 }
                
                 document.getElementById("Alerteditplace1").innerHTML = '<button type="button" id="AlertButton" onclick="'+functionname+'('+PostId+')" class="btn btn-primary">Submit</button>';
                 $("#WhiteL").fadeIn(200);
                 $("#AlertWindow").fadeIn(200);
             }
             
             
            function editpostW(PostId){
                var $keywords = $("#Waifus1").siblings(".tagsinput").children(".tag");  
                var tags = "";  
                for (var i = $keywords.length; i--;) {  
                    tags += $($keywords[i]).text().substring(0, $($keywords[i]).text().length -  1).trim()+',';  
                }  
                var url1 = '/getpost/'+PostId+'/update/waifus/'+tags;
                $.ajax({
                    url: url1,
                    success: function(data) {
                       CloseAlertWindow();
                        UpdateWindow('Post Updated');
                }});
                
            }
             
             function editpostH(PostId){
                var $keywords = $("#Waifus1").siblings(".tagsinput").children(".tag");  
                var tags = "";  
                for (var i = $keywords.length; i--;) {  
                    tags += $($keywords[i]).text().substring(0, $($keywords[i]).text().length -  1).trim()+',';  
                }  
                var url1 = '/getpost/'+PostId+'/update/hashtags/'+tags;
                 alert(url1);
                $.ajax({
                    url: url1,
                    success: function(data) {
                       CloseAlertWindow();
                        UpdateWindow('Post Updated');
                }});
                
            }
             
             function CloseAlertWindow(){
                 $("#CreatePost").fadeOut(200);
                 $("#WhiteL").fadeOut(200);
                 $("#AlertWindow").fadeOut(200);
             }
             
             function yoalert(){
                 alert('yo');
                 
             }
             
             function UpdateWindow(text1){
                     document.getElementById("updateWindow").innerHTML = text1;
                     $("#updateWindow").fadeIn(300);
                     setTimeout(function(){
                          $("#updateWindow").fadeOut(900);
                     }, 2000);
                 }
             
             
             $(document).ready(function() {
                     document.getElementById("fileform").style.display="none";
                     document.getElementById("CreatePost").style.display="none";
                     document.getElementById("updateWindow").style.display="none";
                     document.getElementById("WhiteL").style.display="none";
                     document.getElementById("AlertWindow").style.display="none";
             });
             
             
             
             function updatePosts(Num, Hash, Waifu, Elementid){
                 document.getElementById(Elementid).innerHTML = "";
                 var url1 = '/getpostarraywith/number/'+Num+'/H/'+Hash+'/W/'+Waifu;
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         var f = data[1].length-1;
                         for (var i = 1; i <= f; i=i+1){
                             document.getElementById(Elementid).innerHTML += '<div id="SimplePost" style="background-image: url('+data[2][i]+');" onclick="window.location=\'/ArtDatabase/'+data[1][i]+'\';"><p>#'+data[1][i]+'</p><p><i class="fa fa-heart fa-fw"></i>'+data[3][i]+'</p></div>';
                         }  
                       
            
                     }
                 });
             }
             
             
             function updateWaifus(Num, sortwith, Hfilters, name, Elementid, size){
                 document.getElementById(Elementid).innerHTML = "";
                 var url1 = '/database/number/'+Num+'/sort/'+sortwith+'/H/'+Hfilters+'/findwithname/'+name+'/';
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         var f = data[0].length-1;
                         for (var i = 0; i <= f; i++){
                             if(size == "medium"){
                             var allVoters = data[3][i]+data[4][i]+data[5][i]+data[6][i];
                             var wcanv = ("WChart"+data[7][i]);
                             document.getElementById(Elementid).innerHTML += '<div class="WaifuCardM"><p><a href="/database/waifu/'+data[7][i]+'"><img src="'+data[2][i]+'?w=300&h=300&fit=crop" width="100" height="100"></a></p><p id="1'+wcanv+'"><canvas id="'+wcanv+'" width="100" height="5"></canvas></p><p style="margin-top:5px;"><a class="suporttext1" style="font-size:111%;">'+data[0][i]+'</a></p><p style="margin:1px 1px;"><a class="suporttext2">'+data[1][i]+'</a></p><p style="margin-top:10px;"><a class="suporttext2"><i class="fa fa-user fa-fw"></i>'+allVoters+'</a></p></div>';
                             RatingWCanvas(wcanv,(data[3][i]+1),(data[4][i]+1),(1+data[5][i]),(data[6][i]+1));
                             }
                             if(size == "small"){
                             var allVoters = data[3][i]+data[4][i]+data[5][i]+data[6][i];
                             var wcanv = ("WChart"+data[7][i]);
                             document.getElementById(Elementid).innerHTML += '<a href="/database/waifu/'+data[7][i]+'"><div class="WaifuCardS"><p><img src="'+data[2][i]+'?w=100&h=100&fit=crop" width="70" height="70"></p><p style="margin-top:2px;"><a class="suporttext1" style="font-size:81%;">'+data[0][i]+'</a></p><p style="margin-top:5px;"><a class="suporttext2"><i class="fa fa-user fa-fw"></i>'+allVoters+'</a></p></div></a>';
                             }
                             
                         }  
                       
            
                     }
                 });
             }
             
             function getUsers(Num, sortwith, name, Elementid, size){
                 document.getElementById(Elementid).innerHTML = "";
                 var url1 = '/UserDatabase/getusers/withname/'+name+'/sorting/'+sortwith+'/number/'+Num;
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         var f = data[1].length-1;
                         for (var i = 0; i <= f; i++){
                             if(size == "small"){
                             document.getElementById(Elementid).innerHTML += '<div class="usercardSmall"><p><a href="/UserDatabase/'+data[1][i]+'"><img src="'+data[3][i]+'?w=80px" width="60px"></a></p><p>'+data[2][i]+'</p></div>';
                             }
                              if(size == "medium"){
                             document.getElementById(Elementid).innerHTML += '<div class="usercardMed"><p><a href="/UserDatabase/'+data[1][i]+'"><img src="'+data[3][i]+'?w=100px" width="80px"></a></p><p>'+data[2][i]+'</p><p><i class="fa fa-star fa-fw"></i>  '+data[4][i]+'</p><p>#'+data[1][i]+'</p></div>';
                             }
                             
                         }  
                       
            
                     }
                 });
             }
             
             
             
             </script>
         
         
         
         
         <div id="updateWindow">
         
         </div>
         
         
         
         
         
         
         
         <div id="MainHeader">
        
             <div style="float:left; padding:10px; color:rgba(242,241,239,0.8);">   &nbsp;&nbsp;&nbsp;&nbsp;<a href="/" class="title">myPantheon</a> <a style="color:rgba(242,241,239,0.6);">beta 0.0.8</a></div>
             <div style="float:right; font-size:188%; padding:6px 20px;"><a class="IcButton" href="/WaifuDatabase/update">TU</a>&nbsp;&nbsp;<a class="IcButtonWhite"><i class="fa fa-envelope-square fa-fw"></i></a>&nbsp;&nbsp;<a class="IcButtonWhite" onclick="ShowCreatePost()"><i class="fa fa-pencil-square-o fa-fw"></i></a>&nbsp;&nbsp;<a class="IcButtonWhite"  href="WaifuDatabase/newwaifu"><i class="fa fa-sun-o fa-fw"></i></a></div>
         </div>
         
         
         <section id="MainMenu">
         
             <p><div>
                 <?php  
                    
                        if($userloggedin == true){
                            echo "<p><a href='/UserDatabase/$UserObj->id'><img src=\"$UserObj->AvatarUrl?w=150\" height=\"80\" width=\"80\" class=\"clip-circleAv\"></a></p><div class='userl'><p class='username'>"; 
                            echo $UserObj->name;
                            echo  '</p><p><a class="IcButtonWhite"><i class="fa fa-cog  fa-lg"></i></a> <a class="IcButtonWhite"><i class="fa fa-envelope  fa-lg"></i></a> <a class="IcButtonWhite" href="/auth/logout"><i class="fa fa-sign-out  fa-lg"></i></a></p></div>';
                        }


                 ?>       
    
    
                 
             </div></p>
         <br/>
             
<div class="MenuBut" style="background-color: rgba(242, 120, 75,1);"><a href="/home"><img class="MenuButIcon" src="/Icons/religion8.svg"></a><br/><b>Home</b></div>
<div class="MenuBut" style="background-color: rgba(245, 215, 110,1);"><a href="/mypantheon"><img class="MenuButIcon" src="/Icons/pantheon1.svg"></a><br/><b>My Pantheon</b></div>
<br/>
<div class="MenuBut" style="background-color: rgba(65, 131, 215,1);"><a href="/WaifuDatabase/"><img class="MenuButIcon" src="/Icons/bible5.svg"></a><br/><b>Waifu Database</b></div>
<div class="MenuBut" style="background-color: rgba(63, 195, 128,1);"><a href="/ArtDatabase/"><img class="MenuButIcon" src="/Icons/image84.svg" ></a><br/><b>Art Database</b></div>
<div class="MenuBut" style="background-color: rgba(102, 51, 153,1);"><a href="/UserDatabase/"><img class="MenuButIcon" src="/Icons/user43.svg"></a><br/><b>User Database</b></div>
<br/>
<div class="MenuBut" style="background-color: rgba(108, 122, 137,1);"><a href="/About/"><img class="MenuButIcon" src="/Icons/facial-hair4.svg"></a><br/><b>About</b></div>
                <p><img src="http://mypanteon.com/logo.png" width=60px style="margin: 5px 5px; opacity: 0.2"></p>
         
         <style> 
                     .clip-circleAv {
                         padding: 0px 5px;
                         opacity:1;
                         -webkit-clip-path: circle(40px at center);
                         clip-path: circle(40px at center);
                     }
                     div.userl { 
                         color: rgba(44, 62, 80,0.7);
                         line-height:3px;
                     }
                     
                     div.userl p.username{
                         color: rgba(242,241,239,0.8);
                         padding: 5px 5px;
                         font-size:80%;
                     }
                     
                     div.userl p a{
                         padding:1px 3px;
                     }
                     
         </style>
         </section>
         
         <section id="CenterSection">
         
             @yield('CenterContent')
         
         
             <div id="Footer"><p style="font-size: 18px;">"Did you forget, {{$UserObj->name}}? Your drill is the drill that will pierce the heavens!"</p> <p style="font-size: 11px;">(LOL right here must be the link to site) is a property of A little bit different, LLC. ©2015 All Rights Reserved.</p> </div>
         </section>
         
         <section id="RightSection">
         
             @yield('RightContent')
         
         </section>

         
        <!--div onclick='NewContentHide();' class='darkness' id='hideContentindark'></div>
            
            <section id="ShowIMG" style="width:100%; height=100%; position:fixed; z-index:999999999; ">
                
            </section>
             
          
         <script>
                 function UpdateWindow(text1){
                     document.getElementById("updateWindow").innerHTML = text1;
                     $("#updateWindow").fadeIn(300);
                     setTimeout(function(){
                          $("#updateWindow").fadeOut(900);
                     }, 1000);
                 }
                 $(document).ready(function() {
                    document.getElementById("updateWindow").style.display="none";
                 });
             
             </script>
         
         <script>
             
             function hidecontentandshowArt(ArtId){
                 document.getElementById("ShowIMG").innerHTML="<div class='darkness' id='hideContentindark' style='background-color: rgba(20,20,30, 0.95);'></div>";
                 showArt(ArtId);
             }
             
             function showArt(ArtId){
                 document.getElementById("hideContentindark").innerHTML="";
                 var url1 = '/getpost/'+ArtId;
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         if (data==0){
                            NewContentHide();
                         }else{
                         
                             disableScroll();
                             var windowHeight80 = $(window).height() * 0.2;
                             var imgfullsrc = data[1]+"?h="+windowHeight80;
                             var nextpost = data[5];
                             var lastpost = data[4];
                             
                            
                             //___Original___Url
                             if(data[6]==0){
                                 var originalurlB = "";
                             }else{
                                 var originalurlB = '<a class="IcButton2" href="'+data[6]+'"><i class="fa fa-user fa-2x"></i></a>';
                             }
                             
                             //___Tags___
                             var TagsOnArt = "";
                             if(data[8]==0){
                                 TagsOnArt = "&nbsp;<a class='suporttext1'>No Tags</a>";
                             }else{
                                 for (var i = 0; i <= (data[8]-1); i++){
                                     TagsOnArt += "&nbsp;<a class='Tag' href='/search/tag/"+data[30+i]+"'>"+data[30+i]+"</a>";
                                 }
                             }
                             
                             //___Waifus___
                              var WaifusOnArt = "";
                              if(data[7]==0){
                                 WaifusOnArt = "&nbsp;<a class='suporttext1'>No Waifus</a>";
                             }else{
                                 for (var i = 0; i <= (data[7]-1); i++){
                                     WaifusOnArt += "&nbsp;<a class='Tag' href='/database/waifu/"+data[20+i]+"'>"+data[10+i]+"</a>";
                                 }
                             }
                             
                             if(data[9]==false){
                                var likeicon = '<b id="likeicon1" ><a class="IcButton2" id="likeicon1" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart-o fa-2x\"></i></a></b>'; 
                             }else{
                                var likeicon = '<b id="likeicon1" ><a class="IcButton3" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart fa-2x\"></i></a></b>'; 
                             }
                                 
                             
                             
                             
                             var imgArt = new Image();
                             imgArt.src = imgfullsrc;
                         
                             var imgW;
                             imgArt.onload = function() {
                                 imgW = imgArt.naturalWidth;   
                             
                                 var expandicon = '<a class="IcButton2" href="'+data[1]+'" target="_blank"><i class=\"fa fa-expand fa-2x\"></i></a>';
                                 var linkicon = '<a class="IcButton2" href="javascript: copyToClipboard(\'mypantheon.com/art/'+ArtId+'\')"><i class=\"fa fa-link fa-2x\"></i></a>';
                             
                                 document.getElementById("hideContentindark").innerHTML="<div onclick='showArt("+lastpost+")' class='goleft'><h1 class=\"centertext\"><i class=\"fa fa-angle-left\"></i></h1></div>"+"<div onclick='NewContentHide()' class='closeart'><h1 class=\"centertext\"><img style='opacity: 0.5;' width='30px' height='30px' src='/Icons/cross97.svg'/></h1></div>"+"<div class='img12' style='width:"+imgW+";'><img onclick='showArt("+nextpost+")' src='"+data[1]+"?h="+(windowHeight80*2)+"' width='"+imgW+"' align=\"center\"><div><img src=\""+data[3]+"?w=220\" height=\"80\" width=\"80\" class=\"clip-circleAvInFrame\"><p class='headertext2'>#"+ArtId+"</p><p class='suporttext1'>posted by "+data[2]+"</p><p class='headertext3'>Waifus on this art: "+WaifusOnArt+"</p><p class='headertext3'>Tags:"+TagsOnArt+"</p></div><div id='rightA'><p style='font-size: 85%;'>"+originalurlB+"&nbsp; &nbsp;"+likeicon+"&nbsp; &nbsp;  "+expandicon+"  &nbsp; &nbsp; "+linkicon+"</p></div></div>";
                         }
                         }
                     }
                 });
                  
             }
             
             function NewContentHide(){
                 //document.getElementById("hideContentindark").style.display="none";
                 document.getElementById("ShowIMG").innerHTML="";
                 enableScroll();
             }
             
             $(document).ready(function() {
                 
                 
               documentReadyOnPage();  
             });
            
             
             function copyToClipboard(text1) {
                 alert('link must be coppied but im too dumb to make it happen');
                 UpdateWindow("Link Copied");
             }
             
             function likepost(ArtId){
                // alert('will like post num '+ArtId);
                 var url1 = '/likepost/'+ArtId;
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         if(data == 0){
                            alert('Please Log In'); 
                         }
                         if(data == 1){
                             document.getElementById("likeicon1").innerHTML='<a class="IcButton2" id="likeicon1" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart-o fa-2x\"></i></a>';
                         }
                         if(data == 2){
                             document.getElementById("likeicon1").innerHTML='<a class="IcButton3" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart fa-2x\"></i></a>';
                         }
                     }});
             }
             
             
            </script>
         <style>
             .clip-circleAvInFrame {
                 padding: 0px 8px; 
                 opacity:1; 
                 float:left;
                 -webkit-clip-path: circle(40px at center);
                 clip-path: circle(40px at center);
             }
         </style>
         
         
         
         
         <div id="updateWindow">
         
         </div>
            
      

        <div id="menu">

            <nav class="MainActions">
                <ul>
        
                    <li><a href="/">Home</a></li>
                    <li><a  href="/database/">Database</a></li>
            </ul>
        
            </nav>
        <!?php  if($userloggedin == true){
    
        echo '<nav style=" display: inline;
    float: right;  
    margin-bottom: auto;
    margin-left: auto;
    margin-right: auto;
    margin-top: auto;">
            <ul>
        
            <li style="
 display: inline;
    float: right;  
    margin-bottom: auto;
    margin-left: auto;
    margin-right: auto;
    margin-top: auto;
     padding: 5px 10px;"><a href="/makenewwaifu"; class="IcButton" style="font-size:250%;"><i class="fa fa-plus-circle"></i></a></li>
        
        </ul>
        
    </nav>';
    
        }?>
    
        </div>
        
        <div id="backImg" >
            <img src="h" width=100% >
        </div><div class="darkness" style="z-index:-1"></div>
        
        <section>
        <!--div class="background-image"><span></span></div>
        <div id="header2">
           <div id="Headerlogo"  style="position:relative;
    margin-top: 70px;
    margin-left: 100px;
    float: left;"><img src="http://mypanteon.com/logo.png" height=100px width=100px style="margin-top: 0px; float:left; padding: 10px 10px"><a class="HeaderTitle"><h2>myPanteon</h2></a>
                <br/>
                <br/>
                <a class="headquote">Holy place for every otaku</a> 
            
        </div>
            
            
            
    </section>
            
            
            
            <div id = "globalcontainer">
                <div id="MainContainer">
                   
                    

        @yield('content')

                    
</div>

</div>
<div id="Footer">
    ssssssssssss
    </div-->

            
    </body>
        
        
        
        
        
        <script>
         
         // left: 37, up: 38, right: 39, down: 40,
            // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
            var keys = {37: 1, 38: 1, 39: 1, 40: 1};

            function preventDefault(e) {
                e = e || window.event;
                if (e.preventDefault)
                    e.preventDefault();
                    e.returnValue = false;  
            }

            function preventDefaultForScrollKeys(e) {
                if (keys[e.keyCode]) {
                    preventDefault(e);
                    return false;
                }
            }

            function disableScroll() {
                if (window.addEventListener) // older FF
                    window.addEventListener('DOMMouseScroll', preventDefault, false);
                window.onwheel = preventDefault; // modern standard
                window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
                window.ontouchmove  = preventDefault; // mobile
                document.onkeydown  = preventDefaultForScrollKeys;
            }   

            function enableScroll() {
                if (window.removeEventListener)
                    window.removeEventListener('DOMMouseScroll', preventDefault, false);
                window.onmousewheel = document.onmousewheel = null; 
                window.onwheel = null; 
                window.ontouchmove = null;  
                document.onkeydown = null;  
            }
         
         
            
             
         </script>
        
        
        
        
        
        
</html>
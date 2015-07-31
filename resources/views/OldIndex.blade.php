@extends('GlobalLayout')

@section('content')

<section id="MainLeftColumn" style="height: 2000px;">
    
    
    <?php  
                    
                        if($userloggedin == true){
                            echo "<div id=\"LogedIn\">";
                            echo "<div><img src=\"$UserObj->AvatarUrl?w=200\" height=\"120\" width=\"120\" class=\"clip-circleAv\"></div><h2><p>"; 
                            echo $UserObj->name;
                            echo  '</h2></p><p><a class="IcButton"><i class="fa fa-cog  fa-lg"></i></a> <a class="IcButton"><i class="fa fa-envelope  fa-lg"></i></a> <a class="IcButton" href="/auth/logout"><i class="fa fa-sign-out  fa-lg"></i></a></p></div>';
                        }else{
                           echo "<p><b><a id='Login'>Login</a></b></p><br/>You are not logged in....";
                            echo  '<a href="/auth/login">Login</a><br/>
    <a href="/auth/register">Register</a>';
                        } 


                ?>
       <br/><br/>          
    
    
    <style> 
        .clip-circleAv {
            padding: 5px 35px; 
            opacity:1;
            -webkit-clip-path: circle(60px at center);
                    clip-path: circle(60px at center);
        }
    </style>
    
    
    
    <br/><br/><br/>
    <div id="IndexMenu">
    <nav>
        <ul>
        
            <li><a href="javascript: chPageToGD()">Global Dashboard</a></li>
            <?php if($userloggedin == true){ 
                    echo "<li><a href=\"javascript: chPageToMyPantheon()\">MyPantheon</a></li>"; }
            ?>
        </ul>
        
    </nav>
    </div>
    
    
    
    
    <script>
    var userloggedin = false;
    
    ////////////////////////--------------------CHANGE_PAGE-----------------
   
    function chPageToMyPantheon(){
        
        document.getElementById("Dashboard").style.display="none";
        document.getElementById("MyPantheon").style.display="block";
    }
        
    function chPageToGD(){
        document.getElementById("Dashboard").style.display="block";
        document.getElementById("MyPantheon").style.display="none";
    }
        
       function hideshow(which){
if (!document.getElementById)
return
if (which.style.display=="block")
which.style.display="none"
else
which.style.display="block"
}
        
        
    </script>
    
</section>


<section id="MainRightColumn" style="height: 2000px;">
    <!---------------------------------------------------DASHBOARD----------------------------------->
     
<div id="Dashboard">
    
    <p style="float:left; margin:15px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:150%;"><i class="fa fa-arrow-circle-down"></i>&nbsp;Global Dashboard</a></p> 

    <p style="float:right; margin:15px 20px; margin-bottom:5px; font-size:200%;">
        <a class="AddPostButton" id="Refresh"> <i class="fa fa-refresh"></i></a>
        &nbsp;&nbsp; 
        <?php if($userloggedin == true){ echo '<a class="AddPostButton" id="AddPostButton"> <i class="fa fa fa-pencil-square-o"></i></a>'; } ?>
    </p>
    <br/><hr class="basicDivider">
    
    <div id="PostForm" style="padding:10px 10px;">
        <h2 style=" font-size:110%; margin:2px 4px; padding: 5px 5px;" >Submit holy art to the Pantheon!</h2>
    <!--div class="newDiv" id="newDropzone"><form action="/Pantheon/file-upload"
      class="dropzone" id="Dropzone1"></form></div-->
        
        
        {!! Form::open(['route' => 'post.store', 'files' => true]) !!}
        
        <div style="margin:5px 5px"><a href="javascript: chPostImUrl()" id="selectBt">Image from url</a><a href="javascript: chPostImPC()" id="selectBt">Image from computer</a></div>
        
        <div id="urlform">{!! Form::label('yourIMG_URL') !!} {!! Form::text('urlIMG', null, ['class'=>'form-control', 'id' => 'urlForm1']) !!}</div><div id="fileform">{!! Form::label('yourIMG') !!} {!! Form::file('yourIMG', ['class'=>'form-control']) !!}</div><br/>
        
        {!! Form::label('Waifus in art') !!}{!! Form::text('Waifus', null, ['class'=>'form-control', 'id'=>'Waifus']) !!}<br/>
        
        {!! Form::label('Tags') !!}{!! Form::text('Tags', null, ['class'=>'form-control']) !!}<br/>
        
        {!! Form::label('Url to original') !!}{!! Form::text('original', null, ['class'=>'form-control']) !!}<br/>
        
        {!! Form::label('publishDate') !!} {!! Form::input('date', 'publishDate', date('Y-m-d'), null, ['class'=>'form-control']) !!}<br/>
        
        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
        <br/>
        {!! Form::close() !!}
       
        
        <script>
            
            
            function getWaifustags(){
                var url1 = '/database/getwaifutags/';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Waifus').tagsInput({
                           autocomplete_url:data,
                       });
                
                }});
            }
            function getHashtags(){
                var url1 = '/database/gethashtags/';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#Tags').tagsInput({
                           autocomplete_url:data,
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
            
        
    </div>  

<div id="AllPosts">
    
    </div>
    

    <br/><br/><br/><br/><br/><br/><br/><br/></div>

    <script>
        
        function updatePosts(Num, Hash, Waifu){
            document.getElementById("AllPosts").innerHTML = "";
            var url1 = '/getpostarraywith/number/'+Num+'/H/'+Hash+'/W/'+Waifu;
            $.ajax({
                url: url1,
                success: function(data) {
                    var f = data.length-1;
                    for (var i = 1; i <= f; i=i+2){
                        document.getElementById("AllPosts").innerHTML += '<div id="SimplePost" style="background-image: url('+data[i+1]+');" onclick="hidecontentandshowArt('+data[i]+')"><nav class="PostActionlist"><ul><li><a><i class="fa fa-external-link fa-2x"></i></a></li></ul></nav></div>';
                    }  
                       
            
                }
            });
        }
        
        
        function toggle(el) {
            el.style.display = (el.style.display == 'none') ? '' : 'none'
        }
        
        $(document).ready(function() {
            $('#AddPostButton').click(function() {
                $('#PostForm').fadeToggle(111);
            });
        });

</script>

    <!---------------------------------------------------MY PANTHEON--------------------------------------------->
   
<div id="MyPantheon">
    
    <br/>
    
    <div>
       
    <p style="margin:2px 20px; "><a style="color:rgba(44, 62, 80,0.8); font-size:150%;"><i class="fa fa-cloud"></i>&nbsp;My Pantheon</a></p> 

    <p><hr class="basicDividerlight"></p>

<div id="myBlock">
    <div id="Waifu" class="WaifusCells">
        
        @foreach($myWaifus as $goddess)
    <div><a href="/database/waifu/{{ $goddess->id }}"><p><img src="{{ $goddess->FullImgUrl }}?w=200&h=300&fit=crop" name="Wphoto"  class="Wphoto" width=100></p><p class="l"><?php if(in_array($goddess->id, $Godessids)){ echo "<i class='fa fa-circle-o fa-fw'></i>"; } if(in_array($goddess->id, $Waifuids)){ echo "<i class='fa fa-heart fa-fw'></i>"; } if(in_array($goddess->id, $Goodids)){ echo "<i class='fa fa-thumbs-up fa-fw'></i>"; }  ?>  {{ $goddess->SmName }}</p></a></div>
    
        @endforeach
        
        </div>
    
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    
    </div>
    
    
    
    
    </div>

</div>
    
</section>

<?php if($userloggedin == true){ echo '<script type="text/javascript">
    userloggedin = true;
    </script>';} ?>
  

<script type="text/javascript">
    
    if(userloggedin == false){
        document.getElementById("MyPantheon").innerHTML = " ";
    }
    
    Dropzone.options.dropzone = {
        addRemoveLinks: true,
        
    };
    
    
    var file1 = 0;
    
    
    Dropzone.options.Dropzone1 = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 50, // MB
        maxFiles: 1,
        uploadMultiple: false,
        init: function() {
            this.on("addedfile", function(file) { file1=file; 
                                                });
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
                
            });
        },
        
    };
    
    
    $('#uploadbutton').click(function() {
        var GotTags = $("#Tags").tagit("assignedTags");
        var GotWaifus = $("#WaifuTags").tagit("assignedTags");
        
        var PostName1 = document.getElementById('ArtName').value;
        //alert(PostName1);
        
        var name = "photo.png";

    });
    
    ////////////////////////////////////////---------------------------------TAAGGGS BITCH-------------------------------------------
    function documentReadyOnPage(){
       /* $(ulId).tagit({
                                availableTags: ["tag1","tag2"],
                                    beforeTagAdded: function(event, ui) {
                                        if ($.inArray(ui.tagLabel, TagsArray) == newTagsOkay) {
                                            return false;
                                        }
                                    }
                            }); */
        $('#PostForm').fadeToggle(1);
        updatePosts(50, 0, 0)
        document.getElementById("fileform").style.display="none";
        document.getElementById("MyPantheon").style.display="none";
        //setTimeout(function() { UpdateWindow('yourtexthere'); }, 1000);
    }
    
    
    ////--------If Tag is in array
    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }
    
    
</script>

@endsection
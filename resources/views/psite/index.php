<!--Header okay-->
<?php include $_SERVER["DOCUMENT_ROOT"] . '/Templates/HeadSmall.php'; ?>
<!--PageInfo okay--->

<!--body-->

<section id="MainLeftColumn" style="height: 2000px;">
    
    <div id="IndexMenu">
    <nav>
        <ul>
        
            <li><a href="javascript: chPageToGD()">Global Dashboard</a></li>
            <li><a  href="javascript: chPageToMyPantheon()">MyPantheon</a></li>
            <li><a href="#">About</a></li>
        </ul>
        
    </nav></div>
    
    <script>
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
        <a class="AddPostButton" id="Refresh"> <i class="fa fa-refresh"></i></a>&nbsp;&nbsp;
   <a class="AddPostButton" id="AddPostButton"> <i class="fa fa fa-pencil-square-o"></i></a>
    </p>
        
        
    <br/><hr class="basicDivider"><div id="PostForm">
        <h2 style=" font-size:110%; margin:5px 10px;" >Submit holy art to the Pantheon!</h2>
    <br/>
    <div class="newDiv" id="newDropzone"><form action="/Pantheon/file-upload"
      class="dropzone" id="Dropzone1"></form></div><br/>
        <!form id="fileupload" name="fileupload" enctype="multipart/form-data" method="post" style="padding:10px 10px;">
            
                <!--p style="padding: 5px 5px;"><a>Art:</a><input type="file" name="fileselect" id="fileselect"></input></p-->
                <p style="padding: 5px 5px;"><a>Art Name:</a><input type="text" name="ArtName" id="ArtName"></input></p>
                <p style="padding: 5px 5px;"><a>Waifus on this art:</a><ul id="WaifuTags" style="font-size:90%"></ul></p>
                <p style="padding: 5px 5px;"><a>Tags:</a><ul id="Tags" style="font-size:90%"></ul></p>
<p>
                <ul id="basic_tag_handler"></ul></p>
<p style="padding: 5px 5px;"><input id="uploadbutton" type="button" value="Submit"/></p>
            
        </form>
    
    </div>  

<div id="AllPosts">

    </div>

    <br/><br/><br/><br/><br/><br/><br/><br/></div>

    <script>
        
        function toggle(el) {
            el.style.display = (el.style.display == 'none') ? '' : 'none'
        }
        
        $(document).ready(function() {
            
            NewPostAdd(false);
            $('#AddPostButton').click(function() {
                $('#PostForm').fadeToggle(111);
            });
            $('#Refresh').click(function() {
                NewPostAdd(false);
            });
        });

</script>
    <!---------------------------------------------------MY PANTHEON--------------------------------------------->
    
<div id="MyPantheon">
    <p style="float:left; margin:15px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:150%;"><i class="fa fa-cloud"></i>&nbsp;My Pantheon</a></p> 

    <br/><hr class="basicDivider">


<p><a style="color:rgba(44, 62, 80,0.7); font-size:120%; margin-left:30px;"><i class="fa fa-circle-o fa-fw"></i>&nbsp;Goddesses</a></p>
    <div id="myBlock">
    <div id="Godess" class="WaifusCells">
        
        
    </div>
    
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>
    
    <br/>
    
    <p><a style="rgba(44, 62, 80,0.7); font-size:120%; margin-left:30px;"><i class="fa fa-heart fa-fw"></i>&nbsp;Waifus</a></p>
    <div id="myBlock">
    
    <div id="Waifu" class="WaifusCells">
        
        
        
        </div>
    
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    
    
    
    
    </div>
    <br/>
    <br/>


</section>


<script type="text/javascript">
    
    Dropzone.options.dropzone = {
        addRemoveLinks: true,
    };
    
    
    var file1 = 0;
    
    //////////////////////////----------------------------IMAGE TO PARSE--------------------------------
    var base64 = "V29ya2luZyBhdCBQYXJzZSBpcyBncmVhdCE=";
    
    /*
    // Set an event listener on the Choose File field.
    $('#fileselect').bind("change", function(e) {
      var files = e.target.files || e.dataTransfer.files;
      // Our file var now holds the selected file
      file = files[0];
    });
    
    */
    // This function is called when the user clicks on Upload to Parse. It will create the REST API request to upload this image to Parse.
    
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
    $(document).ready(function() {
       /* $(ulId).tagit({
                                availableTags: ["tag1","tag2"],
                                    beforeTagAdded: function(event, ui) {
                                        if ($.inArray(ui.tagLabel, TagsArray) == newTagsOkay) {
                                            return false;
                                        }
                                    }
                            }); */
        $('#PostForm').fadeToggle(1);
    });
    
    
    ////--------If Tag is in array
    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }
    
    
</script>



<!--footer-->
<?php include $_SERVER["DOCUMENT_ROOT"] . '/Templates/Footer.php'; ?>







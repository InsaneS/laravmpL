@extends('GlobalLayout')


@section('CenterContent')

    <br/>
<div class="BasicDiv" style="text-align:left;">
    
    <p style="text-align:left; margin:0px 5px; margin-top:5px;"><b><a style="color:rgba(44, 62, 80,0.8); font-size:260%;">&nbsp;{{ $waifu->FullName }}</a></b></p> 
    <p class=".suporttext1" style="text-align:left; margin:3px 31px; margin-bottom:5px;"><a href='/search/tag/{{$Archetype->id}}'>{{ $Archetype->name }}</a></p>
    <hr class="basicDividerlight">
    <div class="infoplace">
        <p><b>Age: </b><?php if($waifu->age === null){  echo "No info <a href=\"javascript:ShowAlertWindow('Change Age', 'Type here Age of this Waifu', 'Age', 'editwaifu', 'Age')\" class='IcButton'><i class='fa fa-plus-circle fa-fw'></i></a>"; }else{ echo "&nbsp;<a class='Tag' href='/search/tag/".$waifu->age->name."'>".$waifu->age->name."</a>"; }  ?></p>
        <p><b>InFiction: </b>&nbsp;<a class='Tag' href='/search/fiction/{{ $waifu->fiction->name }}'>{{ $waifu->fiction->name }}</a></p>
        <p><b>Characteristics: </b> @foreach($waifu->hashtags as $Hashtag)   &nbsp;<a class='Tag' href='/search/tag/{{ $Hashtag->name }}'>{{ $Hashtag->name }}</a>@endforeach</p>
        <p><b>Voice Actor: </b><?php if($waifu->va === null){  echo "No info <a href=\"javascript:ShowAlertWindow('Change Voice Acress', 'Type here name of the Voice Actress of this Waifu', 'Voice Actress Tag', 'editwaifu', 'Va')\" class='IcButton'><i class='fa fa-plus-circle fa-fw'></i></a>"; }else{ echo "&nbsp;<a class='Tag' href='/search/tag/".$waifu->va->Name."'>".$waifu->va->name."</a>"; }  ?>                         </p>
    </div>
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All new waifus</a></p>
    </div>
 
 
 
<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-arrow-circle-down fa-fw"></i>&nbsp;Global Dashboard</a></p> 

    <p style="float:right; margin:15px 20px; margin-bottom:5px; font-size:125%;">
        <a class="AddPostButton" id="Refresh"> <i class="fa fa-refresh"></i></a>
        &nbsp;&nbsp; 
        <?php if($userloggedin == true){ echo '<a class="AddPostButton" id="AddPostButton"> <i class="fa fa fa-pencil-square-o"></i></a>'; } ?>
    </p>
    <br/><hr class="basicDivider">
    
    
<div id="AllPosts" style="padding: 2px 5%;">
    
    
    
    </div>
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All posts</a></p>
    </div>

    <script>
        
     
    
       
             function editwaifu(editplace){
                 var waifuid = "{{ $waifu->id }}";
                 var editvalue = document.getElementById("AlertInput").value;
        
                 var url1 = '/WaifuDatabase/'+waifuid+'/edit/'+editplace+'/value/'+editvalue;
                 
                 $.ajax({
                 url: url1,
                 success: function(data) {
                        
                     UpdateWindow(data);
                     CloseAlertWindow();
                 }});
            
             }
    
        
        
        function toggle(el) {
            el.style.display = (el.style.display == 'none') ? '' : 'none'
        }
        

</script>

    


@endsection



@section('RightContent')

<br/>
<div class="BasicDiv" style="overflow: hidden; padding: 0px; align-items: center; text-align: center;">
    
    
    <img src="{{ $waifu->FullImgUrl }}?w=400&h=560&fit=crop" name="Wphoto"  class="Wphoto" style="width:100%;">
    
    
    
    <p id="relationButtons">
        <?php if($relation === 3){
                echo '<a class="WCircleIcon" href="javascript:sendRelationInfo(0);" ><i class="fa fa-circle-o fa-3x"></i></a>';
            }else{
                echo '<a class="IcButtonW" href="javascript:sendRelationInfo(3);" ><i class="fa fa-circle-o fa-3x"></i></a>';
            }
            if($relation === 2){
                echo '<a class="WHeartIcon" href="javascript:sendRelationInfo(0);"><i class="fa fa-heart fa-3x"></i></a>';
            }else{
                echo '<a class="IcButtonW" href="javascript:sendRelationInfo(2);" ><i class="fa fa-heart fa-3x"></i></a>';
            }
            if($relation === 1){
                echo '<a class="WOkayIcon" href="javascript:sendRelationInfo(0)"><i class="fa fa-thumbs-up fa-3x"></i></a>';
            }else{
                echo '<a class="IcButtonW" href="javascript:sendRelationInfo(1)"><i class="fa fa-thumbs-up fa-3x"></i></a>';
            }
            if($relation === -1){
                echo '<a class="WNoIcon" href="javascript:sendRelationInfo(0);"><i class="fa fa-eye-slash fa-3x"></i></a>';
            }else{
                echo '<a class="IcButtonW" href="javascript:sendRelationInfo(-1);"><i class="fa fa-eye-slash fa-3x"></i></a>';
            }?>
        </p>


    <canvas id="WChart" style="width:100%;" height="10"></canvas>
    <p style="padding: 2px 2px; font-size:120%;" id="RatingCount"></p>
    <p style="padding: 4px 4px; font-size:88%; color:rgba(1,1,1,0.3)">#{{ $waifu->id }}</p>
    
    
<script>
    
    
    
function sendRelationInfo(Relationid){
    var url1 = '/database/waifu/{{ $waifu->id }}/relation/'+Relationid;
    $.ajax({
        url: url1,
        success: function(data) {
            var b3 ='<a class="IcButtonW" href="javascript:sendRelationInfo(3);" ><i class="fa fa-circle-o fa-3x"></i></a>';
            var b2 ='<a class="IcButtonW" href="javascript:sendRelationInfo(2);" ><i class="fa fa-heart fa-3x"></i></a>';
            var b1 ='<a class="IcButtonW" href="javascript:sendRelationInfo(1)"><i class="fa fa-thumbs-up fa-3x"></i></a>';
            var bMinus1 ='<a class="IcButtonW" href="javascript:sendRelationInfo(-1);"><i class="fa fa-eye-slash fa-3x"></i></a>';
            if(Relationid==3){
                b3 ='<a class="WCircleIcon" href="javascript:sendRelationInfo(0);" ><i class="fa fa-circle-o fa-3x"></i></a>';
            }
            if(Relationid==2){
                b2 ='<a class="WHeartIcon" href="javascript:sendRelationInfo(0);"><i class="fa fa-heart fa-3x"></i></a>';
            }
            if(Relationid==1){
                b1 ='<a class="WOkayIcon" href="javascript:sendRelationInfo(0)"><i class="fa fa-thumbs-up fa-3x"></i></a>';
            }
            if(Relationid==-1){
                bMinus1 ='<a class="WNoIcon" href="javascript:sendRelationInfo(0);"><i class="fa fa-eye-slash fa-3x"></i></a>';
            }
            document.getElementById("relationButtons").innerHTML= b3+b2+b1+bMinus1;
            UpdateWindow("Relation Updated");
            updateVotesCount();
        }
    });
}

    var canvas = document.getElementById('WChart');
        var ctx = canvas.getContext("2d");
    function degToRad(degree){
        var factor = Math.PI/180;
        return degree*factor;
    }
    
    function updateVotesCount(){
        var url1 = '/database/waifu/{{ $waifu->id }}/updatevotes';
        $.ajax({
        url: url1,
        success: function(data) {
            //alert("1 - "+data[1]+"    2 - "+data[2]+"    3 - "+data[3]+"    4 - "+data[4]);
            var VotesCount = data[1]+data[2]+data[3]+data[4]-4;
            var RatingCount = ((data[1]-1)*3)+((data[2]-1)*2)+data[3]-data[4];
            document.getElementById("RatingCount").innerHTML = '<a class="headertext3a5">&nbsp;<i class="fa fa-star fa-fw"></i>'+RatingCount+'</a>&nbsp;<a class="headertext3a5">&nbsp;&nbsp;<i class="fa fa-user fa-fw"></i>'+VotesCount+'</a>';
            
            
            var W = canvas.width;
            var H = canvas.height;
            var GodRating = data[1];
            var WaifuRating = data[2];
            var BakaRating = data[3];
            var HateRating = data[4];
            var sumR = GodRating+WaifuRating+BakaRating+HateRating;
            
            GodRatingDeg = ((GodRating)/(sumR))*W;
            WaifuRatingDeg = ((WaifuRating)/(sumR))*W;
            BakaRatingDeg = ((BakaRating)/(sumR))*W;
            HateRatingDeg = ((HateRating)/(sumR))*W;
      
      
            var CRadius = 50;
            ctx.fillStyle="rgba(200, 100, 100, 1)";
            ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg+BakaRatingDeg+HateRatingDeg, H);
      
            ctx.fillStyle="rgba(100, 200, 160, 1)";
            ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg+BakaRatingDeg, H);
      
            ctx.fillStyle="rgba(245, 100, 140, 1)";
            ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg, H);
      
            ctx.fillStyle="rgba(255,225,100,1)";
            ctx.fillRect(0, 0, GodRatingDeg, H);
        }});}
   
    $( document ).ready(function() {
        updateVotesCount();
        updatePosts(50, '0', '{{ $waifu->FullName }}', 'AllPosts');
    });

</script>






    
    </div>

@endsection

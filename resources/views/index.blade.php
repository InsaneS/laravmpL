@extends('GlobalLayout')

@section('CenterContent')

<h1 class="PageTitle">Dashboard</h1>


<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-globe fa-fw"></i>&nbsp;Top all</a></p> 

    
    <br/><hr class="basicDivider">
    
    
<div id="Top All" style="overflow-y: hidden; overflow-x: scroll; height:200px; padding: 2px 3%;">
   
    </div>
    
    
     
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
    </div>


<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-circle-o fa-fw"></i>&nbsp;Top Goddesses</a></p> 

    
    <br/><hr class="basicDivider">
    
    
<div id="Top Goddess" style="overflow-y: hidden; overflow-x: scroll; height:125px; padding: 2px 5%;">
   
    </div>
    
    
     
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
    </div>

<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-heart fa-fw"></i>&nbsp;Top Waifus</a></p> 

    
    <br/><hr class="basicDivider">
    
    
<div id="Top Waifu" style="overflow-y: hidden; overflow-x: scroll; height:125px; padding: 2px 3%;">
   
    </div>
    
    
     
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
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
        function toggle(el) {
            el.style.display = (el.style.display == 'none') ? '' : 'none'
        }
        
        $(document).ready(function() {
            updatePosts(20, 0, 0, "AllPosts");
            updateWaifus(20, 'Rating', 0, 0, "Top All", 'medium');
            updateWaifus(20, 'WRating', 0, 0, "Top Waifu", 'small');
            updateWaifus(20, 'GRating', 0, 0, "Top Goddess", 'small');
            updateWaifus(5, 'latestId', 0, 0, "New waifus", 'small');
            getUsers(5, 'latestid', '0', 'NewUsers', 'small');
        });

</script>

    
    <script>
         
         
         
         
         
            function RatingWCanvas(CanvasId, GodRating, WaifuRating, BakaRating, HateRating){
                var canvas = document.getElementById(CanvasId);
                var ctx = canvas.getContext("2d");
                //var GodRating = 11;
                //var WaifuRating = 12;
                //var BakaRating = 1;
                //var HateRating = 2;
                var sumR = GodRating+WaifuRating+BakaRating+HateRating;
            
                var W = canvas.width;
                var H = canvas.height;
            
                var GodRatingDeg = ((GodRating)/(sumR))*W;
                var WaifuRatingDeg = ((WaifuRating)/(sumR))*W;
                var BakaRatingDeg = ((BakaRating)/(sumR))*W;
                var HateRatingDeg = ((HateRating)/(sumR))*W;
                   
                var CRadius = 50;
                ctx.fillStyle="rgba(200, 100, 100, 1)";
                ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg+BakaRatingDeg+HateRatingDeg, H);
      
                ctx.fillStyle="rgba(100, 200, 160, 1)";
                ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg+BakaRatingDeg, H);
      
                ctx.fillStyle="rgba(245, 100, 140, 1)";
                ctx.fillRect(0, 0, GodRatingDeg+WaifuRatingDeg, H);
      
                ctx.fillStyle="rgba(255,225,100,1)";
                ctx.fillRect(0, 0, GodRatingDeg, H);
                var img    = canvas.toDataURL("image/png");
                document.getElementById("1"+CanvasId).innerHTML = '<img src="'+img+'"/>';
            }
         
        </script>



@endsection

@section('RightContent')
<br/>

<div class="BasicDiv">
    
    <p style="float:left; margin:5px 5px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.7); font-size:100%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;New waifus</a></p> 

    <br/><hr class="basicDividerlight">
    
    <div  id="New waifus" style="overflow-y: hidden; overflow-x: scroll; height:130px;">
    </div>
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All new waifus</a></p>
    </div>

<div class="BasicDiv">
    
    <p style="float:left; margin:5px 5px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.7); font-size:100%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;New users</a></p> 

    <br/><hr class="basicDividerlight">
    
    <div id="NewUsers">
    
       
    
    </div>
    
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All new users</a></p>
</div>



<div class="BasicDiv">
    
    <p style="float:left; margin:5px 5px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.7); font-size:100%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Add</a></p> 

    <br/><hr class="basicDividerlight">
    
    <br/><br/>
    <br/>
    <br/>
    <br/>
    Add here
    <br/>
    <br/>
     <br/>
    <br/>
    <br/>
    
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">Want to place here your add?</a></p>
</div>


@endsection
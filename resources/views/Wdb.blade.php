@extends('GlobalLayout')

@section('CenterContent')

<h1 class="PageTitle">Waifu Database</h1>

<p><label style="color:rgba(44, 62, 80,0.6); font-size: 18px; font-weight: 600;">Search with Name<i class="fa fa-search fa-fw"></i></label><input type="text" style="width:70%" id="searchWname" placeholder="Name"></p>
<p><label style="color:rgba(44, 62, 80,0.6); font-size: 18px; font-weight: 600;"> Search with Tags<i class="fa fa-search fa-fw"></i></label><input type="text" style="width:70%" id="TagsW" placeholder="Tags"></p>
<!--p><label style="color:rgba(44, 62, 80,0.6); font-size: 18px; font-weight: 600;"> Search with Fiction<i class="fa fa-search fa-fw"></i></label><input type="text" style="width:70%" placeholder="Fiction"></p-->
<p><button onclick="updateSearch()">Search</button></p>

<script>
    
    var sort = 'Rating';
    var name = '0';
    var tags = '0';
    
    function updateSearch(){
        
        var nameval = document.getElementById("searchWname").value;
        var tagsval = document.getElementById("TagsW").value;
        
        if(nameval != ''){name = nameval;}
        else{name = '0';}
        
        if(tagsval != ''){tags = tagsval;}
        else{tags = '0';}
        
        updateWaifus(50, sort, tags, name, 'All', 'medium');
    }
    
function getHashtags1(){
                var url1 = '/database/gethashtags/2';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#TagsW').tagsInput({
                           autocomplete_url:data,
                           'height':'30px',
                           'width':'auto',
                       });
                
                }});
            }
            getHashtags1();

</script>

<div class="BasicDiv">
    
    <p style="float:left; margin:10px 10px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.9); font-size:85%;">&nbsp;Waifu Database</a></p> 
    <p style="float:right; margin:10px 10px; margin-bottom:5px;" id="sortW"><a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a><a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a></p>
    
    <br/><hr class="basicDividerlight">
    
    
<div id="All" style="height:1000px; display:inline-block;padding: 2px 3%;">
   
    </div>
    
    
     <script>
         
         function sortRating(){
             sort = 'Rating';
             document.getElementById("sortW").innerHTML = '<a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a>&nbsp;&nbsp;<a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a>';
             updateSearch();
         }
         function sortLatest(){
             sort = 'latestId';
             document.getElementById("sortW").innerHTML = '<a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a>&nbsp;&nbsp;<a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a>';
             updateSearch();
         }
         
         
         $(document).ready(function() {
            updateWaifus(50, 'Rating', 0, 0, "All", 'medium');
            updateWaifus(5, 'latestId', 0, 0, "New waifus", 'small');
             updateWaifus(5, 'GRating', 0, 0, "Top Goddess", 'small');
             updateWaifus(5, 'WRating', 0, 0, "Top Waifus", 'small');
            
        });
         
         
            function RatingWCanvas(CanvasId, GodRating, WaifuRating, BakaRating, HateRating){
                var canvas = document.getElementById(CanvasId);
                var ctx = canvas.getContext("2d");
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
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
    </div>

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

<div class="BasicDiv">
    
    <p style="float:left; margin:5px 5px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.7); font-size:100%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Top Goddess</a></p> 

    <br/><hr class="basicDividerlight">
    
    <div  id="Top Goddess" style="overflow-y: hidden; overflow-x: scroll; height:130px;">
    </div>
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All new waifus</a></p>
</div>

<div class="BasicDiv">
    
    <p style="float:left; margin:5px 5px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.7); font-size:100%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Top Waifus</a></p> 

    <br/><hr class="basicDividerlight">
    
    <div  id="Top Waifus" style="overflow-y: hidden; overflow-x: scroll; height:130px;">
    </div>
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All new waifus</a></p>
</div>



@endsection
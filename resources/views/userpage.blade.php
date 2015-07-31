@extends('GlobalLayout')


@section('CenterContent')

    <br/>
<h1 class="PageTitle">{{ $user->name }}'s Pantheon</h1>


<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-circle-o fa-fw"></i>&nbsp;{{ $user->name }}'s Goddesses</a></p> 

    
    <br/><hr class="basicDivider">
    
    
<div id="GoddessU" style="overflow-y: hidden; overflow-x: scroll; height:auto; padding: 2px 5%;">
   
    </div> 
    
    
     
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
    </div>

<div class="BasicDiv">
    
    <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-heart fa-fw"></i>&nbsp;{{ $user->name }}'s Waifus</a></p> 

    
    <br/><hr class="basicDivider">
    
    
<div id="WaifuU" style="overflow-y: hidden; overflow-x: scroll; height:auto; padding: 2px 5%;">
   
    </div>
    
    
     
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All tops</a></p>
    </div>
 
 


    <script>
        
        $(document).ready(function() {
            updateWaifusOfUser('{{$user->id}}', 'Waifu', 'medium', 'WaifuU');
            updateWaifusOfUser('{{$user->id}}', 'Goddess', 'medium', 'GoddessU');
        });

        function updateWaifusOfUser(UserNum, WorG, size, Elementid){
                 document.getElementById(Elementid).innerHTML = "";
                 var url1 = '/WaifuDatabase/waifusorgodess/'+WorG+'/ofuser/'+UserNum;
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

    


@endsection



@section('RightContent')

<br/>
<div class="BasicDiv" style="overflow: hidden; padding: 0px; align-items: center; text-align: center;">
    
    
    <img src="{{ $user->AvatarUrl }}?w=400&h=400&fit=crop" class="clipcircleAvatarUserpage" style="width:90%;">
    
    
    
  <p style="padding: 4px 4px; font-size:150%; color:rgba(44, 62, 80,0.8);">{{ $user->name }}</p>
    <p style="padding: 4px 4px; font-size:90%; color:rgba(44, 62, 80,0.6);"><i class="fa fa-star fa-fw"></i>  {{ $user->Rating }}</p>
    <p style="padding: 4px 4px; font-size:88%; color:rgba(44, 62, 80,0.4);">#{{ $user->id }}</p>
    
    <style>
        .clipcircleAvatarUserpage{
            margin-top: 10px;
            -webkit-clip-path: circle(50% at center);
            clip-path: circle(50% at center);
        }
    
    </style>






    
    </div>

@endsection

@extends('GlobalLayout')

@section('CenterContent')
<br/>
<div class="BasicDiv" style="padding:0px; overflow:hidden; text-align:left; line-height:140%;">
    
    <img src="{{$Post->fullIMG}}" width="100%">
    
    <img src="{{ $Post->author->AvatarUrl }}?w=220" height="80" width="80" class="clip-circleAvInFrame">
    
    <div style="float:right; text-align:right; margin:0px 10px; margin-bottom:5px; font-size:125%;">
        <p style='font-size: 85%;'>@if (count($Post->userlike) === 0) <b id="likeicon1" ><a id="likeicon1" href="javascript:likepost({{$Post->id}})"><i class="fa fa-heart-o fa-2x"></i></a></b>@else <b id="likeicon1" ><a id="likeicon1" class="IcButton3" href="javascript:likepost({{$Post->id}})"><i class="fa fa-heart fa-2x"></i></a></b> @endif
            
            &nbsp; &nbsp;  <a class="IcButton2" href="{{$Post->fullIMG}}" target="_blank"><i class="fa fa-expand fa-2x"></i></a>  &nbsp; &nbsp; <a class="IcButton2" href="javascript: copyToClipboard('mypantheon.com/art/{{$Post->id}}')"><i class="fa fa-link fa-2x"></i></a></p>
    </div>
    
<p style="margin:10px 2px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:135%;">#{{$Post->id}}<br/><a class='suporttext1'>posted by {{ $Post->author->name }}</a></a></p>
    
    
     
    <p class='simpletext1' style="font-size:90%;">Waifus on this art: @foreach($Post->waifus as $waifu) &nbsp;<a class='Tag' href='/database/waifu/{{ $waifu->id }}'>{{ $waifu->FullName }}</a> @endforeach  @if (count($Post->waifus) === 0) No waifus @endif <a href="javascript:ShowAlertWindowinPost('Add Waifus', 'Type here Waifu tags of this Art', 'editpostW', '@foreach($Post->waifus as $waifu1){{ $waifu1->FullName }},@endforeach', '{{$Post->id}}')" class='IcButton'><i class='fa fa-plus-circle fa-fw'></i></a><br/> 
        
    Tags:@foreach($Post->hashtags as $hashtag)&nbsp;<a class='Tag' href='/search/tag/{{$hashtag->name}}'>{{$hashtag->name}}</a>@endforeach @if (count($Post->hashtags) === 0) No tags @endif <a href="javascript:ShowAlertWindowinPost('Add Tags', 'Type here Tags of this Art', 'editpostH', '@foreach($Post->hashtags as $hashtag1){{ $hashtag1->name }},@endforeach', '{{$Post->id}}')" class='IcButton'><i class='fa fa-plus-circle fa-fw'></i></a></p>
    
    
    
    
    
    
    <hr class="basicDividerlight">
    <p style="text-align:right; line-height: 20%; font-size: 80%;"><a href="/404">All posts</a></p>
    </div>

    <script>
         
        function likepost(ArtId){
                //alert('will like post num '+ArtId);
                 var url1 = '/likepost/'+ArtId;
                 $.ajax({
                     url: url1,
                     success: function(data) {
                         if(data == 0){
                            alert('Please Log In'); 
                         }
                         if(data == 1){
                             document.getElementById("likeicon1").innerHTML='<a id="likeicon1" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart-o fa-2x\"></i></a>';
                         }
                         if(data == 2){
                             document.getElementById("likeicon1").innerHTML='<a class="IcButton3" href="javascript:likepost('+ArtId+')"><i class=\"fa fa-heart fa-2x\"></i></a>';
                         }
                     }});
             }
        
        
        $(document).ready(function() {
            updateWaifus(5, 'latestId', 0, 0, "New waifus", 'small');
            
        });

</script>

    <style>
             .clip-circleAvInFrame {
                 padding: 10px 10px; 
                 opacity:1; 
                 float:left;
                 -webkit-clip-path: circle(40px at center);
                 clip-path: circle(40px at center);
             }
         </style>
    



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
    
    <br/><br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    
    
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
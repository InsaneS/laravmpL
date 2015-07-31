@extends('GlobalLayout')

@section('CenterContent')

<h1 class="PageTitle">Art Database</h1>

<p><label style="color:rgba(44, 62, 80,0.6); font-size: 18px; font-weight: 600;"> Search with Tags<i class="fa fa-search fa-fw"></i></label><input type="text" style="width:70%" id="TagsP" placeholder="Tags"></p>
<p><label style="color:rgba(44, 62, 80,0.6); font-size: 18px; font-weight: 600;"> Search with Waifus<i class="fa fa-search fa-fw"></i></label><input type="text" style="width:70%" id="WaifusP" placeholder="Waifus"></p>
<p><button onclick="updateSearch()">Search</button></p>

<script>
            function getWaifustags1(){
                var url1 = '/database/getwaifutags/';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#WaifusP').tagsInput({
                           autocomplete_url:data,
                           availableTags: data,
                           fieldName: "Waifu Tags",
                           'height':'30px',
                           'width':'auto',
                       });
                
                }});
            }
            function getHashtags1(){
                var url1 = '/database/gethashtags/1';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#TagsP').tagsInput({
                           autocomplete_url:data,
                           fieldName: "Hashtags",
                           'height':'30px',
                           'width':'auto',
                       });
                
                }});
            }
    getHashtags1();
    getWaifustags1();
    
    var sort = 'Rating';
    var tagsP = '0';
    var WaifuP = '0';
    function updateSearch(){
        
        var tagsPval = document.getElementById("TagsP").value;
       
        var WaifuPval = document.getElementById("WaifusP").value;
        if(tagsPval != ''){tagsP = tagsPval;}
        else{tagsP = '0';}
        if(WaifuPval != ''){WaifuP = WaifuPval;}
        else{WaifuP = '0';}
         alert(tagsP);
        updatePosts('200', tagsP, WaifuP, 'AllP');
    }
    

</script>

<div class="BasicDiv">
    
    <p style="float:left; margin:10px 10px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.6); font-size:100%;">&nbsp;Art Database</a></p> 
    <p style="float:right; margin:10px 10px; margin-bottom:5px;" id="sortW"><a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a><a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a></p>
    
    <br/><hr class="basicDividerlight">
    
    
<div id="AllP" style="min-height:1000px; width:100%; display:inline-block; padding: 2px 5%;">
   
    </div>
    
    
     <script>
         
         function sortRating(){
             sort = 'Rating';
             document.getElementById("sortW").innerHTML = '<a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a>&nbsp;&nbsp;<a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a>';
             updateSearch();
         }
         function sortLatest(){
             sort = 'latestid';
             document.getElementById("sortW").innerHTML = '<a style="color:rgba(44, 62, 80,0.5); font-size:85%;" onclick="sortRating()">&nbsp;Rating</a>&nbsp;&nbsp;<a style="color:rgba(44, 62, 80,0.8); font-size:85%;" onclick="sortLatest()">&nbsp;Latest</a>';
             updateSearch();
         }
         
         
         $(document).ready(function() {
            updateWaifus(5, 'latestId', 0, 0, "New waifus", 'small');
             updateWaifus(5, 'GRating', 0, 0, "Top Goddess", 'small');
             updateWaifus(5, 'WRating', 0, 0, "Top Waifus", 'small');
             updateSearch();
            
        });
         
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
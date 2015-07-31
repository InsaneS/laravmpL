
</div>

</div>
<div id="Footer">
    ssssssssssss
    </div>
<script>
    
    
    /////////////////////////-------------------------------------TAG_FUNCTION-------------------------------------
    /*
    function Tagblock(TagId){
        var Hashtag = Parse.Object.extend("Hashtags");
var Hquery = new Parse.Query(Hashtag);
        Hquery.get(TagId, {
  success: function(Tag) {
      
      var TagName = Tag.get("Name");
      document.write('<a class="Tag" href="#">' + TagName + '</a>');
      
  }
            error: function(object, error) {
    // The object was not retrieved successfully.
    // error is a Parse.Error with an error code and message.
      
      alert("noTag!!!!!");
  }
            
                   });
                   };
                   */
    
    /////////////////////////----------------------------------------------ADD_WAIFU_FORM--------------------------
     $("body").children("#WhiteBackground").addClass("Hidden");
    $("body").children().not("#WhiteBackground").addClass("unblurred");
            var addWaifuForm1=false;
        
    
            function addWaifuForm(){
                document.getElementById("WhiteBackground").style.display="block";
                addWaifuForm1 = true;
                $("body").children("#WhiteBackground").removeClass("Hidden");
                $("body").children().not("#WhiteBackground").removeClass("unblurred");
                $("body").children().not("#WhiteBackground").addClass("blurred");
                $("body").children("#WhiteBackground").addClass("Active");
            }
    
    
    function endWaifuForm(){
        document.getElementById("WhiteBackground").style.display="none";
                addWaifuForm1 = false;
                $("body").children().not("#WhiteBackground").removeClass("blurred");
                $("body").children("#WhiteBackground").removeClass("Active");
                $("body").children().not("#WhiteBackground").addClass("unblurred");
                $("body").children("#WhiteBackground").addClass("Hidden");
                
            }
            
        

        </script>

    </body>
</html>
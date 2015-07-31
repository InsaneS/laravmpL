@extends('GlobalLayout')

@section('CenterContent')

<h1 class="PageTitle">Add New Waifu</h1>

    <div class="BasicDiv"> 
          <p style="float:left; margin:10px 20px; margin-bottom:5px;"><a style="color:rgba(44, 62, 80,0.8); font-size:125%;"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Add Waifu!</a></p>
        
    <br/><hr class="basicDividerlight">
        
                            {!! Form::open(['route' => 'waifu.store', 'files' => true]) !!}
                            <div style="margin:5px 5px"><a href="javascript: chPostImUrl()" id="selectBt">Image from url</a><a href="javascript: chPostImPC()" id="selectBt">Image from computer</a></div>
        
        <div id="urlform">{!! Form::label('yourIMG_URL') !!} {!! Form::text('urlIMG', null, ['class'=>'form-control', 'id' => 'urlForm1']) !!}</div><div id="fileform">{!! Form::label('yourIMG') !!} {!! Form::file('yourIMG', ['class'=>'form-control']) !!}</div><br/>
                            <p><a>ShortName*:</a>{!! Form::text('WSName', null, ['class'=>'form-control']) !!}</p><br/>
        
             <p><a>FullName*:</a>{!! Form::text('WFName', null, ['class'=>'form-control']) !!}</p><br/>
        
        <p><a>Characteristics*:</a> {!! Form::text('WCharacteristics', null, ['class'=>'form-control', 'id' => 'WCharacteristics']) !!}</p><br/>
                            <p><a>Archetype:</a>
<select class="form-control" name="Archetype">
        @foreach($Archetypes as $a)
            <option value="{{$a->id}}">{{$a->name}}</option>
        @endforeach
</select></p><br/>
                            <p><a>In Fiction*:</a> {!! Form::text('WFiction', null, ['class'=>'form-control']) !!}</p><br/>
        
    <br/><hr class="basicDividerlight">
                           
        <p><button type="submit"  class="btn btn-primary">Submit</button></p>
                            {!! Form::close() !!}
                            </div>
    
    
            <script>
            
              
            function getHashtags11(){
                var url1 = '/database/gethashtags/2';
                $.ajax({
                    url: url1,
                    success: function(data) {
                       $('#WCharacteristics').tagsInput({
                           autocomplete_url:data,
                           fieldName: "Hashtags",
                       });
                
                }});
            }
              getHashtags11();  
            function chPostImPC(){
                document.getElementById("urlForm1").value = "";
                document.getElementById("urlform").style.display="none";
                document.getElementById("fileform").style.display="block";
            }
        
            function chPostImUrl(){
                
                document.getElementById("urlform").style.display="block";
                document.getElementById("fileform").style.display="none";
            }
        
            
            $(document).ready(function() {
                 document.getElementById("fileform").style.display="none";
             });
            
            </script>
            
    
    



@endsection
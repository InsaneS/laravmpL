<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use App\Http\Requests;
use App\Post; //Yes
use App\User; //Yes
use App\Waifu; //Yes
use App\hashtagtype; //Yes
use App\Hashtag; //Yes
use App\fiction; //Yes
use App\Userrole; //Yes
use App\Relationposthashtags;
use App\waifuuserrelations;
use App\Relationpostuserlikes;
use App\Waifupostrelations;
use App\Waifuhashtagrelations;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
 
class GlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */ 
    
     
    
    
    
    public function index()
    {
        
        
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        function Wtop($RatingNum, $HowManyW){
            
            //---------TOP---------
            if($RatingNum != 0){
                $GoddessTop = DB::table('waifuuserrelations')->where(['RelationType_id' => $RatingNum])->lists('Waifu_id');
            }else{
                $GoddessTop = DB::table('waifuuserrelations')->where(['RelationType_id' => array(2,3)])->lists('Waifu_id');
            }
            $GoddessTopIds = getarrayvaluestoanarray($GoddessTop);
            $count=array_count_values($GoddessTopIds);//Counts the values in the array, returns associatve array
            arsort($count);//Sort it from highest to lowest
            $keys=array_keys($count);//Split the array so we can find the most occuring key
            
            $result=[];
            if(count($keys) > $HowManyW){
                $wc = $HowManyW-1;
            }else{
                $wc = count($keys)-1;
            }
            for ($i = 0; $i <= $wc; $i++){
                if($keys[$i] != null){
                    $w = Waifu::where(['id' => $keys[$i]])->first();
                    if($w != null){
                        array_push($result, $w);
                    }
                }
            }
            
            return $result;
            
        }
        
        //
        $Allposts1 = Post::all();
        //dd($posts1);
        $userloggedin = false;
        $posts1 = Post::latest('id')->get();
        $postHeader = Post::latest('id')->first()->fullIMG;
        $postHeaderSmaller = $postHeader.'?w=500';
        
        $userF = 0;
        $waifuGoddess = [];
        $waifuWaifu = [];
        
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            
            $waifuWaifuId = DB::table('waifuuserrelations')->where(['User_id' => $userF->id])->lists('Waifu_id');
            $GoddesIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 3])->lists('Waifu_id');
            $WaifuIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 2])->lists('Waifu_id');
            $GoodIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 1])->lists('Waifu_id');
            $GoddesIds = getarrayvaluestoanarray($GoddesIds1);
            $WaifuIds = getarrayvaluestoanarray($WaifuIds1);
            $GoodIds = getarrayvaluestoanarray($GoodIds1);
            
            
            
            $waifuWaifuIdCount = count($waifuWaifuId)-1;
            if($waifuWaifuId != null){
                for ($i = 0; $i <= $waifuWaifuIdCount; $i++){
                    $w = Waifu::where(['id' => $waifuWaifuId[$i]])->first();
                    if($w != null){
                        array_push($waifuWaifu, $w);
                    }
                }
            }
            
            
            return view('index', ['HeaderImg' => $postHeaderSmaller, 'Allposts' => $Allposts1, 'posts' => $posts1, 'userloggedin' => $userloggedin, 'UserObj' => $userF, 'myWaifus' => $waifuWaifu, 'Godessids' => $GoddesIds, 'Waifuids' => $WaifuIds, 'Goodids' => $GoodIds, 'TopW' => Wtop(3, 10)]);
            
        }else{
            
           
            
            return view('welcome', ['HeaderImg' => $postHeaderSmaller, 'posts' => $posts1, 'userloggedin' => false, 'UserObj' => $userF]);
        }
        
        
    }
    
    public function er404(){
        return view('404e');
    }
    
    /////////////////////////////__________________WAIFU_________DATABASE_______PAGE_______________________ 
    
    
    public function Wdb()
    {
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        $userF = 0;
        $GoddesIds = [];
        $WaifuIds = [];
        $GoodIds = [];
        $userloggedin = false;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            $GoddesIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 3])->lists('Waifu_id');
            $WaifuIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 2])->lists('Waifu_id');
            $GoodIds1 = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'RelationType_id' => 1])->lists('Waifu_id');
            $GoddesIds = getarrayvaluestoanarray($GoddesIds1);
            $WaifuIds = getarrayvaluestoanarray($WaifuIds1);
            $GoodIds = getarrayvaluestoanarray($GoodIds1);
            
        }
        $postHeader = Post::latest('id')->first()->fullIMG;
        $postHeaderSmaller = $postHeader.'?w=900';
        $posts1 = Waifu::latest('id')->get();
        return view('Wdb', ['waifus' => $posts1, 'UserObj' => $userF,  'HeaderImg' => $postHeaderSmaller, 'userloggedin' => $userloggedin,'Godessids' => $GoddesIds, 'Waifuids' => $WaifuIds, 'Goodids' => $GoodIds]);
    }
    
    
    
    
    
    
    /////////////////////////////__________________MAKE_________NEW_________WAIFU_______________________ 
    
    
    public function makenewwaifu()
    {
       
        if (Auth::check()) {
            $userloggedin = false;
            $postHeader = Post::latest('id')->first()->fullIMG;
            $postHeaderSmaller = $postHeader.'?w=900';
            $userF = 0;
            $Archetypes = Hashtag::where(['HashtagType_id' => '3'])->get();
            $userloggedin = true;
            $userF = Auth::user();
            return view('makenewwaifu', ['HeaderImg' => $postHeaderSmaller, 'Archetypes' => $Archetypes, 'userloggedin' => $userloggedin, 'UserObj' => $userF]);
        }
        return view('404e');
        //$posts1 = Post::latest('id')->where('id', '<=', 2)->get();
        
        
    }
    
    
    
    
    
    
    /////////////////////////////__________________SEARCH_WAIFU_______________________ 
    
    
    public function getWaifusWith($num, $sortwith, $Hfilters, $name)
    {
         function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        
        $waifusIds=[];
        
        $WId=[];
        $WName=[];
        $WArchetype=[];
        $WImgUrl=[];
        $WGodNum=[];
        $WWaifuNum=[];
        $WBakaNum=[];
        $WNoNum=[];
        $waifusR=[];
        $waifusRs=[];
        if($name != '0'){
             //___SEARCH BY NAME_____
            
            $name1=explode(" ", $name);
            $waifus1 = Waifu::whereIn('FullName', $name1)->orWhere(['SmName' => $name1]);
            if($Hfilters != '0'){
                $Hashs1=explode(",", $Hfilters);
                $Hashs2=Hashtag::where(['HashtagType_id' => '2'])->whereIn('name', $Hashs1)->lists('id');
                $Hashs3=getarrayvaluestoanarray($Hashs2);
                if($Hashs3 != null){
                    $wid1= Waifuhashtagrelations::whereIn('Hashtag_id', $Hashs3)->lists('Waifu_id');
                    $wid2= getarrayvaluestoanarray($wid1);
                    $waifusR = $waifus1->whereIn('id', $wid2);
                }
                /*
                $Hashs2Arc=Hashtag::where(['HashtagType_id' => '3'])->whereIn('name', $Hashs1)->lists('id');
                $Hashs3Arc=getarrayvaluestoanarray($Hashs2Arc);
                
                if($Hashs3Arc === null){
                    $waifusR = $waifusW;
                }else{
                    if($Hashs3 != null){
                        $waifusR = $waifusW->where(['Archetype' => $Hashs3Arc]);
                    }else{
                        $waifusR = $waifus1->where(['Archetype' => $Hashs3Arc]);
                    }
                }*/
                
            }else{
                $waifusR = $waifus1;
            }
            
        }else{
            if($Hfilters != '0'){
                $Hashs1=explode(",", $Hfilters);
                $Hashs2=Hashtag::where(['HashtagType_id' => '2'])->whereIn('name', $Hashs1)->lists('id');
                $Hashs3=getarrayvaluestoanarray($Hashs2);
                if($Hashs3 != null){
                    $wid1= Waifuhashtagrelations::whereIn('Hashtag_id', $Hashs3)->lists('Waifu_id');
                    $wid2= getarrayvaluestoanarray($wid1);
                    $waifusR = Waifu::whereIn('id', $wid2);
                }
                /*$Hashs2Arc=Hashtag::where(['HashtagType_id' => '3'])->whereIn('name', $Hashs1)->lists('id');
                $Hashs3Arc=getarrayvaluestoanarray($Hashs2Arc);
                
                if($Hashs3Arc === null){
                    $waifusR = $waifusW;
                }else{
                    if($Hashs3 != null){
                        $waifusR = $waifusW->where(['Archetype' => $Hashs3Arc]);
                    }else{
                        $waifusR = Waifu::where(['Archetype' => $Hashs3Arc]);
                    }
                }*/
            }
        }
        
        if($sortwith == 'latestId'){
            if($waifusR == []){
                $waifusRs = Waifu::latest('id');
            }else{
                $waifusRs = $waifusR->latest('id');
            }
        }
        if($sortwith == 'Rating'){
            if($waifusR == []){
                $waifusRs = Waifu::latest('Rating');
            }else{
                $waifusRs = $waifusR->latest('Rating');
            }
        }
        if($sortwith == 'WRating'){
            if($waifusR == []){
                $waifusRs = Waifu::latest('WRating');
            }else{
                $waifusRs = $waifusR->latest('WRating');
            }
        }
        if($sortwith == 'GRating'){
            if($waifusR == []){
                $waifusRs = Waifu::latest('GRating');
            }else{
                $waifusRs = $waifusR->latest('GRating');
            }
        }
        if($sortwith == 'Popularity'){
            if($waifusR == []){
                $waifusRs = Waifu::latest('Rating');
            }else{
                $waifusRs = $waifusR->latest('Rating');
            }
        }
        
        $waifus3 = $waifusRs->lists('id');
        $waifusIds = getarrayvaluestoanarray($waifus3);
        $waifusIdscount = count($waifusIds)-1;
        if($num < count($waifusIds)){
           $waifusIdscount = $num-1;
        }
        for($i = 0; $i <= $waifusIdscount; $i++){
            $w = Waifu::where(['id' => $waifusIds[$i]])->first();
            array_push($WId, $w->id);
            array_push($WName, $w->SmName);
            array_push($WImgUrl, $w->FullImgUrl);
                        
            $Gc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => '3'])->lists('Waifu_id');
            $Gc = getarrayvaluestoanarray($Gc1);
            $Gccount = count($Gc);
            array_push($WGodNum, $Gccount);
                        
            $Wc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => 2])->lists('User_id');
            $Wc = getarrayvaluestoanarray($Wc1);
            $Wccount = count($Wc);
            array_push($WWaifuNum, $Wccount);
                        
            $Bc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => 1])->lists('User_id');
            $Bc = getarrayvaluestoanarray($Bc1);
            $Bccount = count($Bc);
            array_push($WBakaNum, $Bccount);
                        
            $Nc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => -1])->lists('User_id');
            $Nc = getarrayvaluestoanarray($Nc1);
            $Nccount = count($Nc);
            array_push($WNoNum, $Nccount);
            
            $ArchetypeHash = Hashtag::where(['id' => $w->Archetype])->first();
            array_push($WArchetype, $ArchetypeHash->name);
                        
        }
        
        $result1=[
            '0' => $WName,
            '1' => $WArchetype, 
            '2' => $WImgUrl, 
            '3' => $WGodNum, 
            '4' => $WWaifuNum, 
            '5' => $WBakaNum, 
            '6' => $WNoNum, 
            '7' => $WId,
        ];
        
        return $result1;
        
        
    }
    
    
    public function getWaifusOfUser($WorG, $num){
     function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        
        $waifusIds=[];
        
        $WId=[];
        $WName=[];
        $WArchetype=[];
        $WImgUrl=[];
        $WGodNum=[];
        $WWaifuNum=[];
        $WBakaNum=[];
        $WNoNum=[];
        $waifusR=[];
        
        $UserP = User::where(['id' => $num])->first();
        $waifus = $UserP->waifulike->lists('id');
      
        $waifusCount = count($waifus)-1;
        
        if($WorG == 'Waifu'){
         
            for($i = 0; $i <= $waifusCount; $i++){
                $wr = waifuuserrelations::where(['Waifu_id'=>$waifus[$i], 'User_id'=>$num])->first();
                if($wr->RelationType_id != 2){
                    $waifus[$i] = null;
                }
            }
            
        }
        if($WorG == 'Goddess'){
         
            for($i = 0; $i <= $waifusCount; $i++){
                $wr = waifuuserrelations::where(['Waifu_id'=>$waifus[$i], 'User_id'=>$num])->first();
                if($wr->RelationType_id != 3){
                    $waifus[$i] = null;
                }
            }
            
        }
        if($WorG == 'Good'){
         
            for($i = 0; $i <= $waifusCount; $i++){
                $wr = waifuuserrelations::where(['Waifu_id'=>$waifus[$i], 'User_id'=>$num])->first();
                if($wr->RelationType_id != 1){
                    $waifus[$i] = null;
                }
            }
            
        }
        
        $waifusCount = count($waifus)-1;
        for($i = 0; $i <= $waifusCount; $i++){
            if($waifus[$i] != null){
                $w = Waifu::where(['id'=>$waifus[$i]])->first();
            array_push($WId, $w->id);
            array_push($WName, $w->SmName);
            array_push($WImgUrl, $w->FullImgUrl);
                        
            $Gc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => '3'])->lists('Waifu_id');
            $Gc = getarrayvaluestoanarray($Gc1);
            $Gccount = count($Gc);
            array_push($WGodNum, $Gccount);
                        
            $Wc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => 2])->lists('User_id');
            $Wc = getarrayvaluestoanarray($Wc1);
            $Wccount = count($Wc);
            array_push($WWaifuNum, $Wccount);
                        
            $Bc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => 1])->lists('User_id');
            $Bc = getarrayvaluestoanarray($Bc1);
            $Bccount = count($Bc);
            array_push($WBakaNum, $Bccount);
                        
            $Nc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $w->id, 'RelationType_id' => -1])->lists('User_id');
            $Nc = getarrayvaluestoanarray($Nc1);
            $Nccount = count($Nc);
            array_push($WNoNum, $Nccount);
            
            $ArchetypeHash = Hashtag::where(['id' => $w->Archetype])->first();
            array_push($WArchetype, $ArchetypeHash->name);
            }
        }
        //dd($waifus);
        
        $result1=[
            '0' => $WName,
            '1' => $WArchetype, 
            '2' => $WImgUrl, 
            '3' => $WGodNum, 
            '4' => $WWaifuNum, 
            '5' => $WBakaNum, 
            '6' => $WNoNum, 
            '7' => $WId,
        ];
        
        return $result1;
        
    }
    
    /////////////////////////____________________ADMIN____RATING________UPDATE________
    
    
    
    public function UpdateWaifuRating(){
        
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        
        $lol = Waifu::latest('id')->lists('id');
        //dd($lol);
        foreach($lol as $waifuid){
            $Wid = $waifuid;

            $Gc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => '3'])->lists('Waifu_id');
            $Gc = getarrayvaluestoanarray($Gc1);
            $Gccount = count($Gc);
                        
            $Wc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => 2])->lists('User_id');
            $Wc = getarrayvaluestoanarray($Wc1);
            $Wccount = count($Wc);
                        
            $Bc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => 1])->lists('User_id');
            $Bc = getarrayvaluestoanarray($Bc1);
            $Bccount = count($Bc);
                        
            $Nc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => -1])->lists('User_id');
            $Nc = getarrayvaluestoanarray($Nc1);
            $Nccount = count($Nc);
            
            $newRating = ($Gccount*3)+($Wccount*2)+$Bccount-$Nccount;
            //dd($newRating);
            Waifu::where(['id' => $waifuid])->first()->update(['Rating' => $newRating, 'WRating' => $Wccount, 'GRating' => $Gccount]);
            
        }
        
        return redirect('/');
        
    }
    
    
    
    
    
    
    
    /////////////////////////////__________________WAIFU_________PAGE_______________________
    
    public function waifutemp($wId){
        
            
        $postHeader = Post::latest('id')->first()->fullIMG;
        $postHeaderSmaller = $postHeader.'?w=900';
        $userF = 0;
        $userloggedin = false;
        
        $WURel = 0;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            $WURelObj = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'Waifu_id' => $wId])->first();
            if($WURelObj != null){
                $WURel = $WURelObj->RelationType_id;
            }
        }
        
        
        
        $waifu = Waifu::where('id', $wId)->first();
        $archetype = Hashtag::where(['id' => $waifu->Archetype])->first();
        
        
        return view('waifutemp', ['waifu' => $waifu, 'HeaderImg' => $postHeaderSmaller, 'userloggedin' => $userloggedin, 'UserObj' => $userF, 'Archetype' => $archetype, 'relation' => $WURel]);
        dd($wId);
        
    }
    
    
    
    /////////////////////////////__________________WAIFU_________RELATION______ACTION_______________________
    
    public function waifunewrel($wId, $rId){
        
        
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        
        $userF = 0;
        $userloggedin = false;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            
            $waifuuserRel = DB::table('waifuuserrelations')->where(['User_id' => $userF->id, 'Waifu_id' => $wId])->first();
            if($waifuuserRel === null){
                
                $waifuuserRelNew = waifuuserrelations::create([
                    'User_id' => $userF->id,
                    'Waifu_id' => $wId,
                    'RelationType_id' => $rId
                ]);
                
            }else{
                
                if($rId == 0){
                    
                    waifuuserrelations::where(['User_id' => $userF->id, 'Waifu_id' => $wId])->first()->delete();
                }else{
                     
                    waifuuserrelations::where(['User_id' => $userF->id, 'Waifu_id' => $wId])->first()->update(['RelationType_id' => $rId]);
                }
                
            }
        
             $Wid = $wId;

            $Gc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => '3'])->lists('Waifu_id');
            $Gc = getarrayvaluestoanarray($Gc1);
            $Gccount = count($Gc);
                        
            $Wc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => 2])->lists('User_id');
            $Wc = getarrayvaluestoanarray($Wc1);
            $Wccount = count($Wc);
                        
            $Bc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => 1])->lists('User_id');
            $Bc = getarrayvaluestoanarray($Bc1);
            $Bccount = count($Bc);
                        
            $Nc1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $Wid , 'RelationType_id' => -1])->lists('User_id');
            $Nc = getarrayvaluestoanarray($Nc1);
            $Nccount = count($Nc);
            
            $newRating = ($Gccount*3)+($Wccount*2)+$Bccount-$Nccount;
            //dd($newRating);
            Waifu::where(['id' => $Wid])->first()->update(['Rating' => $newRating, 'WRating' => $Wccount, 'GRating' => $Gccount]);
            
            return;
            
        }
    }
      
    
    public function updatevotes($wId){
        
        $Voters3 = DB::table('waifuuserrelations')->where(['Waifu_id' => $wId, 'RelationType_id' => 3])->lists('User_id');
        $Voters3Count = count($Voters3)+1;
        $Voters2 = DB::table('waifuuserrelations')->where(['Waifu_id' => $wId, 'RelationType_id' => 2])->lists('User_id');
        $Voters2Count = count($Voters2)+1;
        $Voters1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $wId, 'RelationType_id' => 1])->lists('User_id');
        $Voters1Count = count($Voters1)+1;
        $Votersm1 = DB::table('waifuuserrelations')->where(['Waifu_id' => $wId, 'RelationType_id' => -1])->lists('User_id');
        $VoterM1Count = count($Votersm1)+1;
        
       $result = [
           '1' => $Voters3Count,
           '2' => $Voters2Count,
           '3' => $Voters1Count,
           '4' => $VoterM1Count,
       ];
        
        return $result;
        
    }

    /////////////////////////////__________________GET_________MOTHERFUCKING______POST_______________________
    
    
    public function getpost($postId)
    {
        
        $post = Post::where(['id' => $postId])->first();
        if ($post===null){
            return 0;
        
        }else{
            $userF = Auth::user();
            $authorid = $post->author_id;
            $author = User::where(['id' => $authorid])->first();
            if (($post->OriginalAuthorUrl)===null){
                $originalurl = 0;
            }else{
               $originalurl = $post->OriginalAuthorUrl;
            }
            $previous = Post::where('id', '<', $post->id)->max('id');
            $next = Post::where('id', '>', $post->id)->min('id');
            
            $likedornot = false;
            $like1 = DB::table('relationpostuserlike')->where(['Post_id' => $postId, 'User_id' => $userF->id])->first();
            if($like1 != null){
                $likedornot = true;  
            }
            
            
            $okay1 = [
                '1' => $post->fullIMG,
                '2' => $author->name,
                '3' => $author->AvatarUrl,
                '4' => $previous,
                '5' => $next,
                '6' => $originalurl,
                '9' => $likedornot,
            ];
            
            $waifuid = DB::table('Waifupostrelations')->where(['post_id' => $post->id])->lists('waifu_id');
            if($waifuid != null){
                $waifuCount = count($waifuid)-1;
                $okay1[7]= count($waifuid);
                for ($i = 0; $i <= $waifuCount; $i++){
                    $w = Waifu::where(['id' => $waifuid[$i]])->first();
                    if($w != null){
                        $okay1[10+$i] = $w->FullName;
                        $okay1[20+$i] = $w->id;
                    }
                }
            }else{
               $okay1[7]= 0; 
            }
            
            $tagsid = DB::table('relationposthashtag')->where(['Post_id' => $post->id])->lists('Hashtag_id');
            if($tagsid != null){
                $tagsCount = count($tagsid)-1;
                $okay1[8]= count($tagsid);
                for ($i = 0; $i <= $tagsCount; $i++){
                    $t = Hashtag::where(['id' => $tagsid[$i]])->first();
                    if($t != null){
                        $okay1[30+$i] = $t->name;
                    }
                }
            }else{
               $okay1[8]= 0; 
            }
             
            return $okay1;
            
        }
    }

    
    /////////////////////////////__________________GET______FILTER______POSTS_______________________
    
    
    public function getallposts($num, $Hfilters, $Wfilters)
    {
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        $postIds = ['0'=>null];
        $postIMGs = ['0'=>null];
        $postLikes = ['0'=>null];
        
        if($Hfilters != '0'){
            if($Wfilters != '0'){
                
                $Hashfilters1 = explode(",", $Hfilters);
                $Hashfilters11count = count($Hashfilters1)-1;
                
                $Waifufilters1 = explode(",", $Wfilters);
                $Waifufilters1count = count($Waifufilters1)-1;
              
                $postsWarray=[];
                for ($i = 0; $i <= $Waifufilters1count; $i++){
                    $wid = Waifu::where(['FullName' => $Waifufilters1[$i]])->first()->id;
                    $wp = Waifupostrelations::where(['waifu_id' => $wid])->lists('post_id');
                    $wpcount = count($wp)-1;
                    for ($l = 0; $l <= $wpcount; $l++){
                        $v = $wp[$l];
                        array_push($postsWarray, $v);
                        
                    }
                }
                $postsHarray=[];
                for ($i = 0; $i <= $Hashfilters11count; $i++){
                    $hid = Hashtag::where(['name' => $Hashfilters1[$i], 'HashtagType_id' => 1])->first()->id;
                    $hp = DB::table('Relationposthashtags')->where(['Hashtag_id' => $hid])->lists('Post_id');
                    $hpcount = count($hp)-1;
                    for ($l = 0; $l <= $hpcount; $l++){
                        array_push($postsHarray, $hp[$l]);
                        
                    }
                }
                
                $postsIdarray = array_intersect($postsWarray, $postsHarray);
                $postsIdarraycount = (count($postsIdarray)-1);
                $postsIdarraycountL = count($postsIdarray);
                if($num < $postsIdarraycountL){
                    $postsIdarraycount = ($num-1);
                }
                //dd($postsIdarraycount);
                for ($i = 0; $i <= $postsIdarraycount; $i=$i+1){
                    //dd($postsIdarray);
                        $p = Post::where(['id' => $postsIdarray[$i]])->first();
                        //dd($p);
                        if($p != null){
                            array_push($postIds, $p->id);
                            array_push($postIMGs, $p->previewIMG);
                            $pl = $p->userlike->lists('name');
                            $likecount = count(getarrayvaluestoanarray($pl));
                            array_push($postLikes, $likecount);
                        
                        }
                    
                }
                
            }else{
                $Hashfilters1 = explode(",", $Hfilters);
                $Hashfilters11count = count($Hashfilters1)-1;
                
                $postsHarray=[];
                for ($i = 0; $i <= $Hashfilters11count; $i++){
                    $hid = Hashtag::where(['name' => $Hashfilters1[$i], 'HashtagType_id' => 1])->first()->id;
                    $hp = DB::table('Relationposthashtags')->where(['Hashtag_id' => $hid])->lists('Post_id');
                    
                    $hpcount = count($hp)-1;
                    for ($l = 0; $l <= $hpcount; $l++){
                       
                         array_push($postsHarray, $hp[$l]);
                        
                    }
                }
                
                $postsIdarray = $postsHarray;
                $postsIdarraycount = count($postsIdarray)-1;
                $postsIdarraycountL = count($postsIdarray);
                if($num < $postsIdarraycountL){
                    $postsIdarraycount = $num-1;
                }
                //dd($postsIdarraycount);
                for ($i = 0; $i <= $postsIdarraycount; $i=$i+1){
                    //dd($postsIdarray);
                        $p = Post::where(['id' => $postsIdarray[$i]])->first();
                        //dd($p);
                        if($p != null){
                            array_push($postIds, $p->id);
                            array_push($postIMGs, $p->previewIMG);
                            $pl = $p->userlike->lists('name');
                            $likecount = count(getarrayvaluestoanarray($pl));
                            array_push($postLikes, $likecount);
                        
                        }
                    
                }
                
            }
        }else{
            if($Wfilters != '0'){
        
                $Waifufilters1 = explode(",", $Wfilters);
                $Waifufilters1count = count($Waifufilters1)-1;
              
                $postsWarray=[];
                for ($i = 0; $i <= $Waifufilters1count; $i++){
                    $wid = Waifu::where(['FullName' => $Waifufilters1[$i]])->first()->id;
                    $wp = Waifupostrelations::where(['waifu_id' => $wid])->lists('post_id');
                    
                    $wpcount = count($wp)-1;
                    for ($l = 0; $l <= $wpcount; $l++){
                        if($wp[$l] != 0){
                            
                            array_push($postsWarray, $wp[$l]);
                        }
                    }
                }
                
                $postsIdarray = $postsWarray;
                $postsIdarraycount = count($postsIdarray)-1;
                $postsIdarraycountL = count($postsIdarray);
                if($num < $postsIdarraycountL){
                    $postsIdarraycount = ($num-1);
                }
                //dd($postsIdarraycount);
                for ($i = 0; $i <= $postsIdarraycount; $i=$i+1){
                    //dd($postsIdarray);
                        $p = Post::where(['id' => $postsIdarray[$i]])->first();
                        //dd($p);
                        if($p != null){
                            array_push($postIds, $p->id);
                            array_push($postIMGs, $p->previewIMG);
                            $pl = $p->userlike->lists('name');
                            $likecount = count(getarrayvaluestoanarray($pl));
                            array_push($postLikes, $likecount);
                        
                        }
                    
                }
                  
            }else{
             
                  
        if(($Hfilters+$Wfilters) == '0'){
           
            $posts1 = array();
            $posts1 = Post::latest('id')->get(); 
            $posts1countL = count($posts1);
            $posts1count = ($posts1countL)*2;
            if($num < $posts1countL){
                $posts1count = ($num)*2;
            }
            for ($i = 1; $i <= $posts1count; $i=$i+2){
                $t = $posts1[(($i)/2)];
                    if($t != null){
                        array_push($postIds, $t->id);
                        array_push($postIMGs, $t->previewIMG);
                        $pl = $t->userlike->lists('name');
                        $likecount = count(getarrayvaluestoanarray($pl));
                        array_push($postLikes, $likecount);
                    }
            }
            
            
        }
                
            }
        }
          
        
        $result = [
                  '1' => $postIds,
                  '2' => $postIMGs,
                  '3' => $postLikes,
                  ];
        
        return $result;
    }
    
    
    /////////////////////////////__________________LIKE_________MOTHERFUCKING______POST_______________________
    
    public function likepost($postId){
        
        if (Auth::check()) {
            
            $userF = Auth::user();
            $post = Post::where(['id' => $postId])->first();
            $like = Relationpostuserlikes::where(['Post_id' => $post->id, 'User_id' => $userF->id])->first();
            if($like != null){
                $like->delete();
                return 1;
            }else{
                Relationpostuserlikes::create(['Post_id' => $post->id, 'User_id' => $userF->id]);
                return 2;
            }
        
        }
        return 0;
    }   
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    
    
    
    
      /////////////////////////////__________________CREATE_____________MOTHERFUCKING_________POST_______________________
    
    public function poststore(Post $postModel, Request $request)
    {
        
     //  dd($request->get('Waifus'));
       // return redirect('/');
        if (Auth::check())
        {
            $userid = Auth::user()->id;
            $Ourl = $request->get('original');
            $post = Post::create(['author_id' => $userid, 'OriginalAuthorUrl' => $Ourl, ]);
            $NextPostId = $post->id;
            
            $url88 = 'images/ArtsFull/PostArtNum'. $NextPostId.'.jpg';
            
            if(empty($request->get('urlIMG'))){
                $filenew = $request->file('yourIMG');
                Storage::put(
                    $url88,
                    file_get_contents($filenew->getRealPath())
                );
                list($width, $height) = getimagesize($filenew->getRealPath());
                
            }else{
                
                Storage::put(
                    $url88,
                    file_get_contents($request->get('urlIMG'))
                );
                list($width, $height) = getimagesize($request->get('urlIMG'));
            }
            
            if (($width - $height)>0){
                $thumbDim= 'h=300';
            }else{
                $thumbDim= 'w=300';
            }
            
            
            $Tags = explode(",", $request->get('Tags'));
            $TagsCount = count($Tags)-1;
            if($TagsCount > 18){
                $TagsCount = 18;
            }
            for ($i = 0; $i <= $TagsCount; $i++){
                $hash = Hashtag::where(['name' => $Tags[$i], 'HashtagType_id' => 1])->first();
                if($hash === null){
                $newHash = Hashtag::create([
                    'name' => $Tags[$i],
                    'HashtagType_id' => 1,
                    'active' => 'true',
                ]);
                Relationposthashtags::create([
                    'Post_id' => $NextPostId,
                    'Hashtag_id' => $newHash->id
                ]);}else{
                Relationposthashtags::create([
                    'Post_id' => $NextPostId,
                    'Hashtag_id' => $hash->id
                ]); 
                }
                
            }
            
            $Waifus = explode(",", $request->get('Waifus'));
            $WaifusCount = count($Waifus)-1;
            if($WaifusCount > 8){
                $WaifusCount = 8;
            }
            for ($i = 0; $i <= $WaifusCount; $i++){
                $w = Waifu::where(['FullName' => $Waifus[$i]])->first();
                if($w === null){
                
                }else{
                  Waifupostrelations::create([
                    'post_id' => $NextPostId,
                    'waifu_id' => $w->id
                ]); 
                }
                
            }
            
            
            Post::where('id', $NextPostId)->first()->update(['previewIMG' => '/img/ArtsFull/PostArtNum'. $NextPostId.'.jpg?'.$thumbDim, 'fullIMG' => '/img/ArtsFull/PostArtNum'. $NextPostId.'.jpg']);
            //$post->previewIMG = '/img/ArtsFull/PostArtNum22.jpg?w=200';
            //$post->fullIMG = '/img/ArtsFull/PostArtNum22.jpg';
            
        }
        return redirect('/');
    }

    
    
      /////////////////////////////__________________CREATE_____________WAIFU_______________________
    
    public function waifustore(Waifu $waifuModel, fiction $fictionModel, Hashtag $hashtagModel, Request $request){
        if (Auth::check())
        {
            
            
            $userid = Auth::user()->id;
            $waifu = Waifu::create([
                'SmName' => $request->get('WSName'),
                'FullName' => $request->get('WFName'),
                'Archetype' => $request->get('Archetype'),
                'author_id' => $userid,
                'active' => 'true',
                            ]);
            
            $NextWaifuId = $waifu->id;
            $url88 = 'images/WaifuAvatar/WaifuAvNum'. $NextWaifuId.'.jpg';
            
            if(empty($request->get('urlIMG'))){
                $filenew = $request->file('yourIMG');
                Storage::put(
                    $url88,
                    file_get_contents($filenew->getRealPath())
                );
                
            }else{
                
                Storage::put(
                    $url88,
                    file_get_contents($request->get('urlIMG'))
                );
            }
            
            $fiction = fiction::where(['name' => $request->get('WFiction')])->first();
            if($fiction === null){
            $fiction = fiction::create([
                'name' => $request->get('WFiction'),
            ]);
            }
            
            
            $CharTags = explode(",", $request->get('WCharacteristics'));
            $CharTagsCount = count($CharTags)-1;
            for ($i = 0; $i <= $CharTagsCount; $i++){
                $hash = Hashtag::where(['name' => $CharTags[$i], 'HashtagType_id' => 2 ])->first();
                if($hash === null){
                    $newHash = Hashtag::create([
                        'name' => $CharTags[$i],
                        'HashtagType_id' => 2,
                        'active' => 1,
                    ]);
                    Waifuhashtagrelations::create([
                        'Waifu_id' => $waifu->id,
                        'Hashtag_id' => $newHash->id
                    ]);}
                else{
                    Waifuhashtagrelations::create([
                        'Waifu_id' => $waifu->id,
                        'Hashtag_id' => $hash->id
                    ]); 
                }
                
            }
            
            
            
            Waifu::where('id', $NextWaifuId)->first()->update(['FullImgUrl' => '/img/WaifuAvatar/WaifuAvNum'. $NextWaifuId.'.jpg', 'Fiction_id' => $fiction->id,]);
            
        
        }
        
        return redirect('/');
    }
    
    
    
      /////////////////////////////__________________GET_____________WAIFUTAGS_______AUTOCOMPETE_______________________
    
    
    public function getallWaifuTags(){
        
        $result = Waifu::latest('id')->lists('FullName');
        
        return $result;
    }
    
    public function getHashTags($type){
        
        $result = Hashtag::where(['HashtagType_id' => $type])->lists('name');
        
        return $result;
        
    }
    
    /////////////////////////////___________________EDIT_____WAIFU________
    
    public function editWaifu($wId, $place, $value){
        
        function newHashtag($name, $type){
            $Hash = Hashtag::where([
                    'name' => $name,
                    'HashtagType_id' => $type,
                ])->first();
            if($Hash===null){
                $newHash = Hashtag::create([
                    'name' => $name,
                    'HashtagType_id' => $type,
                    'active' => 'true',
                ]); 
                return $newHash->id;
            }else{
                return $Hash->id;
            }
        }
        
        if (Auth::check()) {
            if($place == 'Va'){
                $wid = newHashtag($value, 4);
                Waifu::where(['id' => $wId])->first()->update(['VAtag' =>  $wid]);
                
                return 'Success';
            }
             if($place == 'Age'){
                $wid = newHashtag($value, 5);
                Waifu::where(['id' => $wId])->first()->update(['Age' =>  $wid]);
                
                return 'Success';
            }
        }
        
    }
    
    /////////////////////////////__________________SHOW_________POST_________ART_______________________ 
    
    
    public function ArtTempPost($ArtId)
    {
        $Art = Post::where(['id' => $ArtId])->first();
        $userloggedin = false;
        if (Auth::check()) {
            
            $postHeader = Post::latest('id')->first()->fullIMG;
            $postHeaderSmaller = $postHeader.'?w=900';
            $userF = 0;
            $Archetypes = Hashtag::where(['HashtagType_id' => '3'])->get();
            $userloggedin = true;
            $userF = Auth::user();
            return view('ArtTemplate', ['HeaderImg' => $postHeaderSmaller, 'userloggedin' => $userloggedin, 'UserObj' => $userF, 'Post' => $Art]);
        }
        return view('ArtTemplate', ['HeaderImg' => $postHeaderSmaller, 'userloggedin' => $userloggedin, 'Post' => $Art]);
        //$posts1 = Post::latest('id')->where('id', '<=', 2)->get();
        
        
    }
    
    /////////////////////////////__________________Update_________POST_________ART_______________________ 
    
    
    public function updatepostW($postId, $waifus1)
    {
        //$asdf = Post::where(['id'=>'80'])->first()->waifus;
        //dd($waifus);
            
            
        $Art = Post::where(['id' => $postId])->first();
        if (Auth::check()) {
            
            $Waifus = explode(",", $waifus1);
            $WaifusCount = count($Waifus)-1;
            if($WaifusCount > 8){
                $WaifusCount = 8;
            }
            $wr1 = Waifupostrelations::where(['post_id'=> $postId])->get();
            foreach($wr1 as &$relationq1){
                $relationq1->delete();
            } 
                
            for ($i = 0; $i <= $WaifusCount; $i++){
                $w = Waifu::where(['FullName' => $Waifus[$i]])->first();
                if($w === null){
                
                }else{
                    $wr = Waifupostrelations::where(['post_id'=> $postId, 'waifu_id'=> ($w->id)])->first();
                    if($wr === null){
                        Waifupostrelations::create([
                            'post_id' => $postId,
                            'waifu_id' => $w->id
                        ]); 
                    }
                }
                
            }
            
        }
        return 'Success';
        //$posts1 = Post::latest('id')->where('id', '<=', 2)->get();
        
        
    }
    
    
    public function updatepostH($postId, $hashtags1)
    {
        $Art = Post::where(['id' => $postId])->first();
        if (Auth::check()) {
            
            $hashtags = explode(",", $hashtags1);
            $hashtagsCount = count($hashtags)-1;
            if($hashtagsCount > 8){
                $hashtagsCount = 8;
            }
            $hr1 = Relationposthashtags::where(['Post_id'=> $postId])->get();
            foreach($hr1 as &$relationq1){
                $relationq1->delete();
            } 
                
            for ($i = 0; $i <= $hashtagsCount; $i++){
                if($hashtags[$i] != ''){
                $h = Hashtag::where(['name' => $hashtags[$i], 'HashtagType_id' => 1])->first();
                if($h === null){
                    $newHash = Hashtag::create([
                    'name' => $hashtags[$i],
                    'HashtagType_id' => 1,
                    'active' => 'true',
                    ]);
                    Relationposthashtags::create([
                            'Post_id' => $postId,
                            'Hashtag_id' => $newHash->id,
                        ]);
                }else{
                    $hr = Relationposthashtags::where(['Post_id'=> $postId, 'Hashtag_id'=> ($h->id)])->first();
                    if($hr === null){
                        Relationposthashtags::create([
                            'Post_id' => $postId,
                            'Hashtag_id' => $h->id,
                        ]); 
                    }
                }
            }
            }
            
        }
        return 'Success';
        //$posts1 = Post::latest('id')->where('id', '<=', 2)->get();
        
        
    }
    
    /////////////////////////////__________________GET_________USERS______________________________ 
    
    public function GetUsers($name, $sort, $number)
    {
        function getarrayvaluestoanarray($array1){
            $array2 = [];
            $array1count = count($array1)-1;
            
            for ($i = 0; $i <= $array1count; $i++){
                $p = $array1[$i];
                if($p != null){
                    array_push($array2, $p);
                        
                }
                
            }
            return $array2;
        }
        
        
        $result = [];
        
        $resultId = [];
        $resultName = [];
        $resultImg = [];
        $resultRating = [];
        
        if($name == '0'){
            
            if($sort == 'latestid'){
                $users = User::latest('id')->get();
                $usersCount = count($users)-1;
                if($usersCount > $number){
                    $usersCount = $number;
                }
                for($i = 0; $i <= $usersCount; $i++){
                    if($users[$i] != null){
                        array_push($resultId, $users[$i]->id);
                        array_push($resultName, $users[$i]->name);
                        array_push($resultImg, $users[$i]->AvatarUrl);
                        array_push($resultRating, $users[$i]->Rating);
                    }
                }
                
                
            }
            if($sort == 'Rating'){
                $users = User::latest('Rating')->get();
                $usersCount = count($users)-1;
                if($usersCount > $number){
                    $usersCount = $number;
                }
                for($i = 0; $i <= $usersCount; $i++){
                    if($users[$i] != null){
                        array_push($resultId, $users[$i]->id);
                        array_push($resultName, $users[$i]->name);
                        array_push($resultImg, $users[$i]->AvatarUrl);
                        array_push($resultRating, $users[$i]->Rating);
                    }
                }
                
                
            }
            
        }
        
        $result = [
            '1' =>  $resultId,
            '2' => $resultName,
            '3' => $resultImg,
            '4' => $resultRating,
        ];
        return $result;
    }

    
     /////////////////////////////__________________________USER___DATABASE___________________________  
    
    public function UserDatabase(){
        
        $userloggedin = false;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            
        }
        return view('Udb', ['userloggedin' =>  $userloggedin, 'UserObj' => $userF]);
        
    }
    
    
    /////////////////////////////__________________________POSTS___DATABASE___________________________  
    
    public function ArtDatabase(){
        
        $userloggedin = false;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            
        }
        return view('Pdb', ['userloggedin' =>  $userloggedin, 'UserObj' => $userF]);
        
    }
    
     /////////////////////////////__________________________USER___PAGE___________________________ 
    
    public function UserPage($num)
    {
        $userObj = User::where(['id' => $num])->first();
        
        $userloggedin = false;
        if (Auth::check()) {
            $userloggedin = true;
            $userF = Auth::user();
            
        }
        return view('userpage', ['user' => $userObj, 'userloggedin' =>  $userloggedin, 'UserObj' => $userF]);
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

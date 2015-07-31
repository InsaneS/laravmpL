<div id="menu">

    <nav class="MainActions">
        <ul>
        
            <li><a href="/Pantheon/index.php">Home</a></li>
            <li><a  href="/Pantheon/database.php">Database</a></li>
            <li><a href="/Pantheon/About.php">About</a></li>
            <?php if(isset($_SESSION['CurrentUser'])){
            echo "<li><a href=\"/Pantheon/MyPage.php\">MyPantheon</a></li>";
            }?>
        </ul>
        
    </nav>
<?php if(isset($_SESSION['CurrentUser'])){
    
    echo "<nav class=\"UserActions\">
        <ul>
        
            <li><a><input class=\"MenuButton\" type=\"image\" src=\"/Pantheon/ButtonIcons/AddWaifu.png\" onclick=\"addWaifuForm()\" height=\"40\" width=\"40\"></input></a></li>
            <li><a><input class=\"MenuButton\" type=\"image\" src=\"/Pantheon/ButtonIcons/AddWaifu.png\" onclick=\"addWaifuForm()\" height=\"40\" width=\"40\"></input></a></li>
            <li><a><input class=\"MenuButton\" type=\"image\" src=\"/Pantheon/ButtonIcons/AddWaifu.png\" onclick=\"addWaifuForm()\" height=\"40\" width=\"40\"></input></a></li>
        
        </ul>
        
    </nav>";
    
}
    
    
    ?>
    
    
</div>
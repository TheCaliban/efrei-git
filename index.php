<?php

    /* PARTIE ÉCRITURE DANS LE FICHIER friends.txt */

    $filename = 'friends.txt';

    if(isset($_POST['friends_name']))
    {
        // appending to file
        $file = fopen($filename, "a");
        if(!empty(trim($_POST['friends_name'])))
        {
            fwrite($file, htmlspecialchars($_POST['friends_name']). "\n");
        }
        fclose($file);
    }

?>

<form action="" method="post">
    <label for="friends_name">Name: </label><input type="text" name="friends_name" id="friends_name" />
    <input type="submit" value="Add new friends" />
</form>

<h2>My Best Friends</h2>


<form method="post">
<ul>

    <?php
    
        /* PARTIE POUR L'AFFICHAGE */

        if(file_exists($filename))
        {
            $file = fopen( $filename, "r" );
            $counter = 0;
            
            while (!feof($file))
            {
                $txt = fgets($file);
                if(isset($_POST['nameFilter']) && !empty(trim($_POST['nameFilter'])))
                {
                    
                    
                    if(isset($_POST['startingWith']) && $_POST['startingWith'] === 'true')
                    {

                        if(substr($txt, 0, strlen($_POST['nameFilter'])) == $_POST['nameFilter'])
                        {
                            echo (strstr($txt, strip_tags($_POST['nameFilter']))) ? '<li>'.$txt. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
//                            exit;
                        }
                    }
                    else
                    {
                        echo (strstr($txt, strip_tags($_POST['nameFilter']))) ? '<li>'.$txt. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
                    }
                }
                else
                {
                    echo (!empty(trim($txt))) ? '<li>'.$txt. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
                    echo ''; 
                }
                
                $counter++;
                // reading file
            }
            fclose($file);
        }

    ?>
    
</ul>
</form>


<form action="" method="post">

    <input type="text" name="nameFilter" id="nameFilter" value="<?php echo (isset($_POST['nameFilter'])) ? strip_tags($_POST['nameFilter']) : ''; ?>"/>
    <input type="submit" value="Filter List"/>
    <input type="checkbox" name="startingWith" <?php echo (isset($_POST['startingWith']) && $_POST['startingWith']) ? 'checked' : ''; ?> value="true">Only names starting with</input>
</form>
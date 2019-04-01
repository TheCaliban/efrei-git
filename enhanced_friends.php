<?php

    $arName = array();
    $filename = 'friends.txt';
    $nameFilter = "";

    /* Adding name into an array */

    if(file_exists($filename))
    {
        $file = fopen($filename, "r");
        
        while(!feof($file))
        {
            $line = fgets($file);
            if(!empty(trim($line)))
            {
                array_push($arName, $line);
            }
        }
        
        fclose($file);
    }

    if(isset($_POST['friends_name']))
    {
        array_push($arName, strip_tags($_POST['friends_name']));
    }

    if(isset($_POST['delete']))
    {
        unset($arName[intval($_POST['delete'])]);
        $arName = array_values($arName);
    }


    $file = fopen($filename, "w");
    if(!empty($arName))
    {
        foreach($arName as $name)
        {
            fwrite($file, $name. "\n");
        }
    }
    fclose($file);

    

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Extended friends book</title>
        
        <style>
            
            body
            {
                margin: 0;
                padding: 0; 
            }
            
            header
            {
                background-color: #666;
                padding: 30px;
                text-align: center;
                font-size: 35px;
                color: white;
            }
            
            footer
            {
                background-color: #777;
                padding: 10px;
                text-align: center;
                color: white;
            }

        
        </style>
    </head>
    
    <body>
        
        <header>Header</header>
        
        <br/>
        
        <form action="" method="post">
            <label for="friends_name">Name: </label><input type="text" name="friends_name" id="friends_name" />
            <input type="submit" value="Add new friends" />
        </form>

        <h2>My Best Friends</h2>


        <form method="post">
        <ul>

            <?php

                /* PARTIE POUR L'AFFICHAGE */

                if(!empty($arName))
                {
                    $counter = 0;

                    foreach($arName as $name)
                    {
                        if(isset($_POST['nameFilter']) && !empty(trim($_POST['nameFilter'])))
                        {

                            $nameFilter = $_POST['nameFilter'];
                            
                            if(isset($_POST['startingWith']) && $_POST['startingWith'] === 'true')
                            {

                                if(substr($name, 0, strlen($nameFilter)) == $nameFilter)
                                {
                                    echo (strstr($name, strip_tags($nameFilter))) ? '<li>'.$name. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
                                }
                            }
                            else
                            {
                                echo (strstr($name, strip_tags($nameFilter))) ? '<li>'.$name. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
                            }
                        }
                        else
                        {
                            echo (!empty(trim($name))) ? '<li>'.$name. '<button type="submit" name="delete" value="'.$counter.'">Delete</button></li>' : '';
                        }

                        $counter++;
                    }
                }

            ?>

        </ul>
        </form>


        <form action="" method="post">

            <input type="text" name="nameFilter" id="nameFilter" value="<?php echo $nameFilter; ?>"/>
            <input type="submit" value="Filter List"/>
            <input type="checkbox" name="startingWith" <?php echo (isset($_POST['startingWith']) && $_POST['startingWith']) ? 'checked' : ''; ?> value="true">Only names starting with</input>
        </form>
    
        <br/>
    
        <footer>Footer</footer>
    
    </body>
    
</html>
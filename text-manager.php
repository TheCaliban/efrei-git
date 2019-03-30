<?php
    
    $title = 'Text-Manager';
    $text = '';

    if(isset($_POST['url']) && !empty($_POST['url']))
    {
        try
        {
            $url = strip_tags($_POST['url']);
            if(!preg_match('/\.txt$/i', $url))
            {
                
                throw new Exception('File is not a txt file');
            }
            else
            {
                $text = file_get_contents($url);
                
/*
                $file_from_url = @fopen($url, 'r');
                if(!$file_from_url)
                {
                    throw new Exception('File not found on remote server');
                }
                while(!feof($file_from_url))
                {
                    $text .= fgets($file_from_url);
                }
                fclose($file_from_url);
*/
            }

        }
        catch(Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    if(isset($_POST['keywords']) && !empty($text) && !empty(trim($_POST['keywords'])))
    {
        $keywords = preg_split('/\s+/', strip_tags($_POST['keywords']));
        
//        exit;
        foreach($keywords as $key=>$value)
        {
            echo $key. " => ". $value. "<br/>";
//            substr_replace($text, '<span id="'.$key.'"></span>', $text);
        }
    }

?>

<!DOCTYPE html>
<html>

    <head>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap 4.2.1 CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        
    
    </head>

    <body>
        
        <div class="container-fluid">
            
            <div class="row text-center bg-warning" style="height: 200px;">
            
                <div class="col-md-12 align-bottom">
                    <h2>Text-Manager</h2>
                </div>
            </div>
                        
            <br/>
    
            <div class="row">
                
                <div class="col-md-5">
            
                    <form action="text-manager.php" method="POST" class="position-fixed col-md-5">

                        <div class="form-row">
                            
                             <div class="col-md-12">
                                 
                                 <div class="form-group col col-md-12">
                                 
                                    <label for="fetch" class="col col-md-12">1. Get text
                                        <input type="text" class="form-control" name="url" id="url" value="<?php echo (!empty($_POST['url'])) ? $_POST['url'] : '' ?>"/>
                                     </label>
                                     <br/>
                                     <input type="submit" class="btn btn-success" value="FETCH TEXT"/>
                                 
                                 </div>
                                 
                                 <div class="form-group col col-md-12">
                                 
                                    <label for="keywords" class="col col-md-12">2. Find Keywords
                                        <input type="text" class="form-control" name="keywords" id="keywords"/>
                                     </label>
                                     <br/>
                                     <input type="submit" class="btn btn-success" value="SEARCH TEXT"
                                     
                                 </div>
                                 
                            </div>
                                 
                            </div>
                            
                        </div>

                    </form>

                </div>
                
                <div class="col-md-7">
                
                    <pre><code>
                        <?php echo (strlen($text) > 1) ? $text   : 'Display the downloaded text here...'; ?>
                    </code></pre>

                </div>
                                
            </div>            
            
        </div>    
    
    </body>

</html>
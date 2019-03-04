<?php

    if(!isset($_GET['op']))
    {
        echo "Missing argument for operator !";
        exit;
    }
    if(!isset($_GET['x']))
    {
        echo "Missing argument for x !";
        exit;
    }
    if(!isset($_GET['y']))
    {
        echo "Missing argument for y !";
        exit;
    }

    $x = intval($_GET['x']);
    $y = intval($_GET['y']);

    switch($_GET['op'])
    {
        case 'sum': 
            echo $x + $y;
            break;
            
        case 'sub': 
            echo $x - $y;
            break;
            
        case 'div':
            echo ($y != 0) ? $x / $y : 'Null division';
            break;
            
        case 'mul': 
            echo $x * $y;
            break;
            
        default:
            echo 'Unrecognized operation: '. $_GET['op'];
            break;
    }

?>
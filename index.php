<?php

    class Calculator
    {
        function sum($x, $y)
        {
            return $x + $y;
        }
        function subtract($x, $y)
        {
            return $x - $y;
        }
        function multiply($x, $y)
        {
            return $x * $y;
        }
        function divide($x, $y)
        {
            if($y != 0)
            return $x / $y;
        }
    }

    $calculator = new Calculator();
    echo $calculator->sum(5, 7). "\n";
    echo $calculator->subtract(8, 2). "\n";
    echo $calculator->multiply(2, 5). "\n";
    echo $calculator->divide(20, 4). "\n";

    echo "<br/>";

    if(isset($_GET['name']))
    {
        echo htmlspecialchars($_GET['name']). "\r\n";
    }

    
?>
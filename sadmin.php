<?php
session_start();
echo $_SESSION["sid"];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
    <a href="adds.php"><button>ADD SALESMAN</button></a>
    </div>
    <div>
    <a href="deletes.php"><button>DELETE SALESMAN</button></a>
    </div>
    <div>
    <a href="viewo.php"><button>VIEW ORDER DETAILS</button></a>
    </div>
    <div>
    <a href="addst.php"><button>ADD STOCK</button></a>
    
    </div>
  
    <div>
    <a href="viewstock.php"><button>VIEW STOCK</button></a>
    
    </div>
    <div>
    <a href="views.php"><button>VIEW CURRENT STOCK</button></a>
    
    </div>
    <div>
    <a href="upst.php"><button>UPDATE STOCK</button></a>
    
    </div>
</body>
</html>
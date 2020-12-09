<?php 

    session_start();
    $letters = ["Α","Β","Γ","Δ","Ε","Ζ","Η","Θ","Ι","Κ","Λ","Μ","Ν","Ξ","Ο","Π","Ρ","Σ","Τ","Υ","Φ","Χ","Ψ","Ω"];
    $words = ["ΟΥΡΑΚΟΤΑΓΚΟΣ","ΤΡΙΧΟΠΤΩΣΗ","ΜΑΛΔΙΒΕΣ","ΠΑΠΑΡΟΥΝΟΣΠΟΡΟΣ","ΑΕΡΟΣΑΚΟΣ","ΑΞΙΟΘΑΥΜΑΣΤΟΣ","ΛΑΧΤΑΡΙΣΤΟΣ","ΑΝΑΙΜΑΚΤΑ","ΒΡΑΒΕΙΟ","ΑΔΙΕΞΟΔΟ","ΠΑΡΑΣΚΕΥΑΖΩ","ΑΡΩΓΗ","ΝΑΥΤΙΛΙΑ","ΠΟΡΤΟΛΑΝΟΣ","ΚΑΤΣΑΡΟΛΑ","ΗΜΕΡΟΛΟΓΙΟ","ΑΚΑΔΗΜΙΑ","ΑΕΡΟΠΛΑΝΟ"];
    if (!isset($_SESSION['newword'])) $_SESSION['newword']= true;
    if (!isset($_SESSION['letters'])) $_SESSION['letters']= [];
   
    if (isset($_GET['letter'])){
        array_push($_SESSION['letters'],$_GET['letter']);
    } else {
        $_GET['letter']='';
        $_SESSION['letters']=[];
        $_SESSION['tries']=10;
        $_SESSION['newword']=true;

     }


    if($_SESSION['newword']){
        $Rand_Index = array_rand($words);
        $_SESSION['word'] = $words[$Rand_Index];
        $_SESSION['newword']=false;


    } 
    $wordarray = preg_split('//u',$_SESSION['word'],0,PREG_SPLIT_NO_EMPTY);
    if (!isset($_SESSION['tries'])) $_SESSION['tries']= 10;
    if (isset($_GET['letter']) && !in_array($_GET['letter'],$wordarray)){
        $_SESSION['tries']--;
    }
    

    
    



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Κρεμάλα</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container">
    <h1>
    <span class ="word">
    <?php 

          $found = true;
          foreach($wordarray as $l){
            if(in_array($l,$_SESSION['letters'])) echo $l;
          
             else {
             echo'_';
             $found=false;
             }

          }

    
    ?>
    </span>
    </h1>
    <h1>

        <?php foreach($letters as $index => $letter): ?>
          <?php if ($index %6 ==0) echo '<br>' ?>
          <?php if(in_array($letter,$_SESSION['letters'])): ?>
            <button class="btn btn-danger"><?= $letter ?> </button>
          <?php else: ?>  
             <a href ="<?= $_SERVER['PHP_SELF'] ?>?letter=<?= $letter ?>"><button class="btn btn-info"><?= $letter ?> </button></a> 
          <?php endif ?>
        <?php endforeach ?>

    </h1>
    <h2>
    <?php
    
    if($found){
        echo'Κερδίσατε';
        $_SESSION['newword']= true;

    }else
        if ($_SESSION['tries'] <= 0){
              $_SESSION['tries']=10;
              $_SESSION['letters']=[];
              echo 'Δυστυχώς χάσατε ...Η λέξη είναι η :'.$_SESSION['word'];
              $_SESSION['newword']=true;
        } else{
              echo 'Σας απομένουν ακόμα '. $_SESSION['tries'].' προσπάθειες'; 
    }
    ?>
    </h2>
    <a href ="<?php echo $_SERVER['PHP_SELF'] ?>"><button class="btn btn-primary">Νέο Παιχνίδι !</button></a> 


</div>
    
</body>
</html>
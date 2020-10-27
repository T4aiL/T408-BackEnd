<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <style>
        html,form, input{
            font-family:Arial;
            font-size:1.5em;
        }
        table{
            border:1px solid gray;
            border-radius:10px;
            padding:10px;
        }
        td{
            padding:10px;
        }
        #container{
            font-family:Arial;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        input{
            width:100%;
            font-size:1em;
        }
    </style>
</head>
<body>
<div id="container">
<form>
    <table>
        <tr>
            <td>Imie:</td>
            <td><input type="text" name="imie"></td>
        </tr>
        <tr>
            <td>Nazwisko:</td>
            <td><input type="text" name="nazwisko"></td>
        </tr>
        <tr>
            <th colspan=2><input type="submit" value="Dodaj"></th>
        </tr>
    </table>
    <div id="message">
    
    

    <?php
        //połączenie

        $conn = mysqli_connect("localhost","root","","users");

        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        //dodawanie
        if(!empty($_GET['imie']) && !empty($_GET['nazwisko'])){
            $insertsql = "INSERT INTO people VALUES (NULL, '" . $_GET['imie'] . "', '" . $_GET['nazwisko'] . "')";
            $result = mysqli_query($conn,$insertsql);

            if($result){
                echo "Osoba dodana do bazy!";
            }
        } else {
            echo "Wypelnij wszystkie pola";
        }

        //wypisanie

        ?>
        <ul id="users">
        <?php
        $selectsql = "SELECT * FROM people";

        $selectresult = mysqli_query($conn,$selectsql);

        if($selectresult){
            while($row = mysqli_fetch_array($selectresult)){
                echo "<li>" . $row['imie'] . " " . $row['nazwisko'] . "</li>";
            }
        } else {
            echo "Nic nie zostało pobrane z bazy";
        }
    ?>
    </ul>
</div></form>
</div>
</body>
</html>
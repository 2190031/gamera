<?php
require('conn.php');

// $query = "SELECT * FROM help";
// $querySec = "SELECT * FROM help_sec, help WHERE help.id = help_sec.id";
// $queryTer = "SELECT * FROM help_ter, help_sec WHERE help_sec.id=help_ter.id";

// $result = $conn->query($query);
// $resultSec = $conn->query($querySec);
// $resultTer = $conn->query($queryTer);

//     if ($result->num_rows > 0) {
//         while ($rowP = $result->fetch_assoc()) {
//             echo "<input id='$rowP[id]' type='radio' value='".$rowP['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowP['title']."`, this.value)' hidden>
//             <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
//                 document.getElementById(".$rowP['id'].").checked = true;
//                 var event = new Event(`change`);
//                 document.getElementById(`$rowP[id]`).dispatchEvent(event);
//             '>".$rowP['title']."</a>
//             <button type='button' class='btn btn-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowP['id']."`, `".$rowP['title']."`, `". $rowP['content']."`)'>Editar</button>
//             <br>";
//             if ($resultSec->num_rows > 0) {
//                 while ($rowS = $resultSec->fetch_assoc()) {
//                     if ($rowS['id'] == $rowP['id']){
//                         echo "<input id='$rowS[id]' type='radio' value='".$rowS['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowS['title']."`, this.value)' hidden>
//                         <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
//                         document.getElementById(".$rowS['id'].").checked = true;
//                         var event = new Event(`change`);
//                         document.getElementById(`$rowS[id]`).dispatchEvent(event);
//                         '>".$rowS['title']."</a>
//                         <button type='button' class='btn btn-success btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowS['id']."`, `".$rowS['title']."`, `". $rowS['content']."`)'>Editar</button>
//                         <br>";
//                         if ($resultTer->num_rows > 0) {
//                             while ($rowT = $resultTer->fetch_assoc()) {
//                                 if ($rowT['id'] == $rowS['id']) {
//                                     echo "<input id='$rowT[id]' type='radio' value='".$rowT['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowT['title']."`, this.value)' hidden>
//                                     <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
//                                     document.getElementById(".$rowT['id'].").checked = true;
//                                     var event = new Event(`change`);
//                                     document.getElementById(`$rowT[id]`).dispatchEvent(event);
//                                     '>".$rowT['title']."</a>
//                                     <button type='button' class='btn btn-secondary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowT['id']."`, `".$rowT['title']."`, `". $rowT['content']."`)'>Editar</button>
//                                     <br>";
//                                 } else {
//                                     break;
//                                 }
//                             }
//                         }
//                     } else {
//                         break;
//                     }
//                 }
//             }
//         }
//     } else {
//         echo "no results";
//     }
$count = 0;
$query = "SELECT * FROM help";
$querySec = "SELECT * FROM help_sec, help WHERE help.id = help_sec.id";
$queryTer = "SELECT * FROM help_ter, help_sec WHERE help_sec.id=help_ter.id";

$result = $conn->query($query);
$resultSec = $conn->query($querySec);
$resultTer = $conn->query($queryTer);

$rowsP = array();
$rowsS = array();
$rowsT = array();

if ($result->num_rows > 0) {
    while ($rowP = $result->fetch_assoc()) {
        $rowsP[] = $rowP;
    }
}

if ($resultSec->num_rows > 0) {
    while ($rowS = $resultSec->fetch_assoc()) {
        $rowsS[] = $rowS;
    }
}

if ($resultTer->num_rows > 0) {
    while ($rowT = $resultTer->fetch_assoc()) {
        $rowsT[] = $rowT;
    }
}

foreach ($rowsP as $rowP) {
    echo "<input id='$rowP[id]' type='radio' value='".$rowP['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowP['title']."`, this.value)' hidden>
    <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
        document.getElementById(".$rowP['id'].").checked = true;
        var event = new Event(`change`);
        document.getElementById(`$rowP[id]`).dispatchEvent(event);
    '>".$rowP['title']."</a>
    <button type='button' class='btn btn-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowP['id']."`, `".$rowP['title']."`, `". $rowP['content']."`)'>Editar</button>
    <br>";
    foreach ($rowsS as $rowS) {
        if ($rowS['id'] == $rowP['id']){
            echo "<input id='$rowS[id]' type='radio' value='".$rowS['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowS['title']."`, this.value)' hidden>
            <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
            document.getElementById(".$rowS['id'].").checked = true;
            var event = new Event(`change`);
            document.getElementById(`$rowS[id]`).dispatchEvent(event);
            '>".$rowS['title']."</a>
            <button type='button' class='btn btn-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowS['id']."`, `".$rowS['title']."`, `". $rowS['content']."`)'>Editar</button>
            <br>";
            foreach ($rowsT as $rowT) {
                if ($rowT['id'] == $rowS['id']){
                    echo "<input id='$rowT[id]' type='radio' value='".$rowT['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowT['title']."`, this.value)' hidden>
                    <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
                    document.getElementById(".$rowT['id'].").checked = true;
                    var event = new Event(`change`);
                    document.getElementById(`$rowT[id]`).dispatchEvent(event);
                    '>".$rowT['title']."</a>
                    <button type='button' class='btn btn-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowT['id']."`, `".$rowT['title']."`, `". $rowT['content']."`)'>Editar</button>
                    <br>";
                }
            }
        }
    }
}
?>
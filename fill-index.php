<?php
require('conn.php');

$query = "SELECT * FROM help";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($rowP = $result->fetch_assoc()) {
        echo "<input id='$rowP[id]' type='radio' value='".$rowP['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowP['title']."`, this.value)' hidden>
        <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
            document.getElementById(".$rowP['id'].").checked = true;
            var event = new Event(`change`);
            document.getElementById(`$rowP[id]`).dispatchEvent(event);
        '>".$rowP['title']."</a>
        <button type='button' href='#title' class='btn btn-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowP['id']."`, `".$rowP['title']."`, 1, `". $rowP['content']."`)'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
        </svg>
        </button>
        <br>";
        
        $querySec = "SELECT * FROM help_sec WHERE id=$rowP[id]";
        $resultSec = $conn->query($querySec);
            if ($resultSec->num_rows > 0) {
                while ($rowS = $resultSec->fetch_assoc()) {
                        echo "<input id='$rowS[id]' type='radio' value='".$rowS['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowS['title']."`, this.value)' hidden>
                        <a href='#content' class='link-success lh-lg' id='scroll-nav-link' onclick='
                        document.getElementById(".$rowS['id'].").checked = true;
                        var event = new Event(`change`);
                        document.getElementById(`$rowS[id]`).dispatchEvent(event);
                        '>".$rowS['title']."</a>
                        <button type='button' href='#title' class='btn btn-success btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowS['id']."`, `".$rowS['title']."`, 2, `".$rowS['content']."`)'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                            </svg>
                        </button>
                        <br>";
                        if ($resultSec->num_rows > 0) {
                            while ($rowS = $resultSec->fetch_assoc()) {
                                echo "<input id='$rowS[id]' type='radio' value='".$rowS['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowS['title']."`, this.value)' hidden>
                                <a href='#content' class='link-info lh-lg' id='scroll-nav-link' onclick='
                                document.getElementById(".$rowS['id'].").checked = true;
                                var event = new Event(`change`);
                                document.getElementById(`$rowS[id]`).dispatchEvent(event);
                                '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rowS['title']."</a>
                                <button type='button' href='#title' class='btn btn-info btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`".$rowS['id']."`, `".$rowS['title']."`, `". $rowS['content']."`)'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                    </svg>
                                </button>
                                <br>";
                                $queryTer = "SELECT * FROM help_ter WHERE id_parent = $rowS[id]";
                                $resultTer = $conn->query($queryTer);
                                if ($resultTer->num_rows > 0) {
                                    while ($rowT = $resultTer->fetch_assoc()) {
                                        echo "<input id='$rowT[id]' type='radio' value='".$rowT['content']."' name='helpDoc' onchange='showTitleAndCont(`".$rowT['title'].", this.value)' hidden> 
                                        <a href='#content' class='link-secondary lh-lg' id='scroll-nav-link' onclick='
                                        document.getElementById(".$rowT['id'].").checked = true; 
                                        var event = new Event(change); document.getElementById($rowT[id]).dispatchEvent(event); '>".$rowT['title']."</a> 
                                        <button type='button' class='btn btn-secondary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(".$rowT['id'].", ".$rowT['title'].", 3, ". $rowT['content']."`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                            </svg>
                                        </button>
                                        <br>";
                                    }
                                }
                            }
                        }
                    }
                }             
            }
        } else {
            echo "No hay resultados";
        }

 $conn->close();
?>
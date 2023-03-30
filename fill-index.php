<?php
require('conn.php');
?>

<div class="row">
    <div class="col-4">
        <div class="h-100 flex-column align-items-stretch pe-4 border-end">
            <div class="d-grid gap-2">
                <button type="button" title="Refrescar índice" class="btn btn-outline-primary" id="refresh-index" onclick="refreshIndex()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                    </svg>
                </button>
            </div>
            <nav id="navbar" class="nav nav-pills flex-column">
                <br>
                <div class="card border-primary list-group-item">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Primario</h5>
                        <?php
                        $query = "SELECT * FROM help";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($rowP = $result->fetch_assoc()) {
                                echo "<input id='$rowP[id]' type='radio' value='" . $rowP['content'] . "' name='helpDoc' onchange='showTitleAndCont(`" . $rowP['title'] . "`, this.value)' hidden>
                                <a href='#content' class='link-primary lh-lg' id='scroll-nav-link' onclick='
                                    document.getElementById(" . $rowP['id'] . ").checked = true;
                                    var event = new Event(`change`);
                                    document.getElementById(`$rowP[id]`).dispatchEvent(event);
                                '>" . $rowP['title'] . "</a>
                                <div class='btn-group btn-sm float-end'>
                                    <button type='button' title='Editar contenido' href='#title' class='btn btn-outline-primary btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`" . $rowP['id'] . "`, `" . $rowP['title'] . "`, 1, `" . $rowP['content'] . "`)'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                    </svg>
                                    </button>
                                    <button type='button' href='#title' title='Mostrar contenido desde el archivo " . $rowP['filename'] . "' class='btn btn-outline-primary btn-sm float-end' id='print-btn' onclick='printFile(`" . $rowP['title'] . "`, `" . $rowP['folder'] . "`)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                                            <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                                            <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                                        </svg>
                                    </button>
                                    <button type='button'  href='#title' class='btn btn-outline-primary btn-sm float-end' onclick='primaryToIndex(`" . $rowP['title'] . "`,`primary`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'>
                                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                            </svg>
                                        </button>
                                </div>
                                <br>";
                            }
                        } else {
                            echo "No hay resultados";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="card border-success list-group-item">
                        <div class="card-body">
                            <h5 class="card-title text-success">Secundario</h5>
                            <?php
                            $query_name = "SELECT help.title FROM help_sec, help WHERE help_sec.prim_parent = help.id;";
                            $result2 = $conn->query($query_name);
                            if ($result2->num_rows > 0) {
                                $parName = $result2->fetch_assoc();
                            }

                            $querySec = "SELECT * FROM help_sec";
                            $resultSec = $conn->query($querySec);
                            if ($resultSec->num_rows > 0) {
                                while ($rowS = $resultSec->fetch_assoc()) {
                                    echo "<input id='S-$rowS[id]' type='radio' value='" . $rowS['content'] . "' name='helpDoc' onchange='showTitleAndCont(`" . $rowS['title'] . "`, this.value)' hidden>
                                    <a href='#content' class='link-success lh-lg' id='scroll-nav-link' onclick='
                                    document.getElementById(`S-" . $rowS['id'] . "`).checked = true;
                                    var event = new Event(`change`);
                                    document.getElementById(`S-$rowS[id]`).dispatchEvent(event);
                                    '>" . $rowS['title'] . "</a>
                                    <div class='btn-group btn-sm float-end'>
                                        <button type='button' title='Editar contenido' href='#title' class='btn btn-outline-success btn-sm float-end' id='scroll-nav-btn' onclick='editCont(`" . $rowS['id'] . "`, `" . $rowS['title'] . "`, 2, `" . $rowS['content'] . "`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                            </svg>
                                        </button>
                                        <button type='button' title='Mostrar contenido desde el archivo " . $rowS['filename'] . "' href='#title' class='btn btn-outline-success btn-sm float-end' id='print-btn' onclick='printFile(`" . $rowS['filename'] . "`, `" . $rowS['folder'] . "`, `" . $rowS['title'] . "`, `" . $parName['title'] . "`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                                                <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                                                <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                                            </svg>
                                        </button>
                                        <button type='button'  href='#title' class='btn btn-outline-success btn-sm float-end' onclick='addToIndex(`" . $parName['title'] . "`,`secondary`,`" . $rowS['title'] . "`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'>
                                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                            </svg>
                                        </button>
                                    </div>
                                    <br>";
                                }
                            } else {
                                echo "No hay resultados";
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="card border-danger list-group-item">
                        <div class="card-body">
                            <h5 class="card-title text-danger">Terciario</h5>
                            <?php
                            $query_name = "SELECT help_sec.title FROM help_sec, help_ter WHERE help_ter.sec_parent = help_sec.id;";
                            $result2 = $conn->query($query_name);
                            if ($result2->num_rows > 0) {
                                $parName = $result2->fetch_assoc();
                            }

                            $queryTer = "SELECT * FROM help_ter";
                            $resultTer = $conn->query($queryTer);
                            if ($resultTer->num_rows > 0) {
                                while ($rowT = $resultTer->fetch_assoc()) {
                                    $filename = $rowT['title'] . "-PN-" . $parName['title'];

                                    echo "<input id='T-$rowT[id]' type='radio' value='" . $rowT['content'] . "' name='helpDoc' onchange='showTitleAndCont(`" . $rowT['title'] . "`, this.value)' hidden> 
                                <a href='#content' class='link-danger lh-lg' id='scroll-nav-link' onclick='
                                document.getElementById(`T-" . $rowT['id'] . "`).checked = true; 
                                var event = new Event(`change`); 
                                document.getElementById(`T-$rowT[id]`).dispatchEvent(event); '>" . $rowT['title'] . "</a> 
                                <div class='btn-group btn-sm float-end'>
                                    <button type='button' title='Editar contenido' class='btn btn-outline-danger btn-sm float-end' id='scroll-nav-btn' onclick='editCont(" . $rowT['id'] . ", `" . $rowT['title'] . "`, 3, `" . $rowT['content'] . "`)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                        </svg>
                                    </button>
                                    <button type='button' title='Mostrar contenido desde el archivo " . $rowT['filename'] . "' href='#title' class='btn btn-outline-danger btn-sm float-end' id='print-btn' onclick='printFile(`" . $rowT['filename'] . "`, `" . $rowT['folder'] . "`, `" . $rowT['title'] . "`, `" . $parName['title'] . "`)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                                            <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                                            <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                                        </svg>
                                    </button>
                                    <button type='button'  href='#title' class='btn btn-outline-danger btn-sm float-end' onclick='addToIndex(`" . $parName['title'] . "`,`terciary`,`" . $rowT['title'] . "`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'>
                                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                            </svg>
                                        </button>
                                </div>
                                <br>";
                                }
                            } else {
                                echo "No hay resultados";
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="card border-warning list-group-item">
                        <div class="card-body">
                            <h5 class="card-title text-warning">Cuaternario</h5>
                            <?php
                            $query_name = "SELECT help_ter.title FROM help_ter, help_cuat WHERE help_cuat.ter_parent = help_ter.id;";
                            $result2 = $conn->query($query_name);
                            if ($result2->num_rows > 0) {
                                $parName = $result2->fetch_assoc();
                            }

                            $queryCuat = "SELECT * FROM help_cuat";
                            $resultCuat = $conn->query($queryCuat);
                            if ($resultCuat->num_rows > 0) {
                                while ($rowC = $resultCuat->fetch_assoc()) {
                                    $filename = $rowC['title'] . "-PN-" . $parName['title'];

                                    echo "<input id='C-$rowC[id]' type='radio' value='" . $rowC['content'] . "' name='helpDoc' onchange='showTitleAndCont(`" . $rowC['title'] . "`, this.value)' hidden> 
                                <a href='#content' class='link-warning lh-lg' id='scroll-nav-link' onclick='
                                document.getElementById(`C-" . $rowC['id'] . "`).checked = true; 
                                var event = new Event(`change`); 
                                document.getElementById(`C-$rowC[id]`).dispatchEvent(event); '>" . $rowC['title'] . "</a> 
                                <div class='btn-group btn-sm float-end'>
                                    <button type='button' title='Editar contenido' class='btn btn-outline-warning btn-sm float-end' id='scroll-nav-btn' onclick='editCont(" . $rowC['id'] . ", `" . $rowC['title'] . "`, 4, `" . $rowC['content'] . "`)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                        </svg>
                                    </button>
                                    <button type='button' title='Mostrar contenido desde el archivo " . $rowC['filename'] . "' href='#title' class='btn btn-outline-warning btn-sm float-end' id='print-btn' onclick='printFile(`" . $rowC['filename'] . "`, `" . $rowC['folder'] . "`, `" . $rowC['title'] . "`, `" . $parName['title'] . "`)'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                                            <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                                            <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                                        </svg>
                                    </button>
                                    <button type='button'  href='#title' class='btn btn-outline-warning btn-sm float-end' onclick='addToIndex(`" . $parName['title'] . "`,`quaternary`,`" . $rowC['title'] . "`)'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus' viewBox='0 0 16 16'>
                                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                            </svg>
                                        </button>
                                </div>
                                <br>";
                                }
                            } else {
                                echo "No hay resultados";
                            }
                            ?>
                        </div>
                    </div>
            </nav>
        </div>
    </div>

    <div class="col-8">
        <div data-bs-spy="scroll" data-bs-target="#navbar" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
            <p>Resultado</p>
            <div id="parent">
                <small class="fw-light">Este articulo pertenece a: <p id="show-parent"></p></small>
            </div>
            <div id="output">
                <div id="title"></div>

                <div id="content"></div>
            </div>
        </div>
    </div>
    <!-- </div> -->
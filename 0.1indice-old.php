<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/gamera/css/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2a3b3d5bf4.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Prata&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/gamera_logo-vector.png" type="image/x-icon">
  <title>Gamera</title>
  <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

  <script>
    $(document).ready(function () {
      $('#1').click(function () {
        $("#contenido").load("funcionamiento_general.html");
      });

      $('#1_2').click(function () {
        $("#contenido").load("ventana_de_listado_tipo_simple.html");
      });

      $('#1_3').click(function () {
        $("#contenido").load("ventana_de_listado_con_filtro_de_datos.html");
      });

      $('#1_4').click(function () {
        $("#contenido").load("elementos_comunes_de_las_ventanas.html");
      });

      $('#1_5').click(function () {
        $("#contenido").load("ventana_de_reportes.html");
      });

      $('#2_1').click(function () {
        $("#contenido").load("estaciones.html");
      });

      $('#2_2').click(function () {
        $("#contenido").load("zonas.html");
      });

      $('#2_3').click(function () {
        $("#contenido").load("usuarios.html");
      });

      $('#2_4').click(function () {
        $("#contenido").load("permisos.html");
      });

      $('#2_5').click(function () {
        $("#contenido").load("2.5adms_como_crear_usuario.html");
      });

      $('#2_6').click(function () {
        $("#contenido").load("2.6adms_como_agregar_permisos.html");
      });

      $('#2_7').click(function () {
        $("#contenido").load("2.7adms_como_crear_estacion.html");
      });

      $('#2_8').click(function () {
        $("#contenido").load("2.8adms_como_crear_zona.html");
      });
      $('#2_9').click(function () {
        $("#contenido").load("2.9adms_como_cerrar_sesiones");
      });
    });
  </script>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Gamera</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <form method="get" action="buscador.php" class="d-flex" role="search">
              <input class="form-control me-2" id="search" type="text" name="q" id="buscador" placeholder="Búsqueda" aria-label="Search" style="width: 400px;" autocomplete="off">
            </form>
          </div>
          <ul id="results"></ul>
      </nav>
    </header>
    <div class="general">

        <div class="contenido" id="conten">

      <section class="box" id="contenido">

        <h2>SISTEMA</h2>

        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi sapiente natus, corrupti dolore dolorem
          doloremque. Accusantium, placeat velit! Sit accusamus ipsa rem a vel exercitationem tempora sequi voluptatem
          nobis adipisci! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, omnis sunt eius commodi
          quae repellat reprehenderit amet, recusandae ab eos odit in, eveniet nam veniam obcaecati doloribus ad
          dignissimos soluta?</p> <br>

        <h2>AYUDA</h2>

        <p>Esta es la seccion de ayuda, aqui podra ver el funcionamiento de cada elemento del sistema. Tiene un indice a
          su izquierda que lo llevara a la ayuda que necesite, de igual forma, habra un buscador en la parte superior
          derecha para buscar cosas mas especificas.</p>
        <br>
        <img src="img/GameraIndice.png" width="600" alt="" class="box-img">

      </section>

    </div>

    <div class="indice" id="indice">

      <section class="box-indice">

        <center><img class="gamera" src="img/gamera_logo.png"></center>
        <br>

        <ul id="myUL" class="treeview">
          <li><span class="caret"><a href="#" class="ola1">Introduccion</a></span>
            <ul class="nested">
              <li><a href="#" id="1" class="ola">Funcionamiento general del sistema</a></li>
              <li><span class="caret"><a href="#" id="1_1" class="ola2">Ventanas</a></span>
                <ul class="nested">
                  <li><a href="#" id="1_2" class="ola">Ventana de Listado Tipo Simple</a></li>
                  <li><a href="#" id="1_3" class="ola">Ventana de listado con filtro de datos</a></li>
                  <li><a href="#" id="1_4" class="ola">Elementos Comunes de las Ventanas</a></li>
                  <li><a href="#" id="1_5" class="ola">Ventana de Reportes</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>

        <ul id="myUL" class="treeview">
          <li><span class="caret"><a href="#" class="ola1">Funcionamiento del sistema</a></span>
            <ul class="nested">
              <li><span class="caret"><a href="#" class="ola2">Administracion</a></span>
                <ul class="nested">
                  <li><span class="caret"><a href="#" class="ola">Sistema</a></span>
                    <ul class="nested">
                      <li><a href="#" id="2_1" class="ola">-Estaciones</a></li>
                      <li><a href="#" id="2_2" class="ola">-Zonas</a></li>
                      <li><a href="#" id="2_3" class="ola">-Usuarios</a></li>
                      <li><a href="#" id="2_4" class="ola">-Permisos y Sesiones</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="#" id="2_5" class="ola">-¿Como crear un usuario?</a></li>
                          <li><a href="#" id="2_6" class="ola">-¿Como agregar permisos a un usuario?</a></li>
                          <li><a href="#" id="2_7" class="ola">-¿Como crear una estacion?</a></li>
                          <li><a href="#" id="2_8" class="ola">-¿Como crear una zona?</a></li>
                          <li><a href="#" id="2_9" class="ola">-¿Como cerrar sesiones en la central?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><span class="caret"><a href="#" class="ola">Archivos</a></span>
                    <ul class="nested">
                      <li><a href="#" id="" class="ola">-Archivos Generales</a></li>
                      <li><a href="#" id="" class="ola">-Clientes</a></li>
                      <li><a href="#" id="" class="ola">-Clasificacion de Clientes</a></li>
                      <li><a href="#" id="" class="ola">-Abogados</a></li>
                      <li><a href="#" id="" class="ola">-Cobradores</a></li>
                      <li><a href="#" id="" class="ola">-Empleados</a></li>
                      <li><a href="#" id="" class="ola">-Inversionistas</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-¿Como agregar colaboradores?</a></li>
                          <li><a href="#" class="ola">-¿Como agregar clientes?</a></li>
                          <li><a href="#" class="ola">-¿Como crear empleados?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar socios?</a></li>
                          <li><a href="#" class="ola">-¿Como crear un oficial de cuenta?</a></li>
                          <li><a href="#" class="ola">-¿Como crear empresas?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar proveedores?</a></li>
                          <li><a href="#" class="ola">-¿Como agregar estados financieros a un cliente?</a></li>
                          <li><a href="#" class="ola">-¿Como agregar los tipos de ajustes para utilizar en el
                              cuadre?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><span class="caret"><a href="#" class="ola">Edicion</a></span>
                    <ul class="nested">
                      <li><a href="#" class="ola">-Solicitudes</a></li>
                      <li><a href="#" class="ola">-Prestamos y Pago de Cuotas</a></li>
                      <li><a href="#" class="ola">-Recibos</a></li>
                      <li><a href="#" class="ola">-Inversiones</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-¿Como crear un prestamos?</a></li>
                          <li><a href="#" class="ola">-¿Como crear un prestamo linea de tiempo?</a></li>
                          <li><a href="#" class="ola">-¿Como crear una solicitud?</a></li>
                          <li><a href="#" class="ola">-¿Como enviar un prestamo a incobrable?</a></li>
                          <li><a href="#" class="ola">-¿Como hacer un acuerdo de pago?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar depositos de cobradores?</a></li>
                          <li><a href="#" class="ola">-¿Como configurar la pantalla del Pagare Notarial?</a></li>
                          <li><a href="#" class="ola">-¿Como se cambia el estado de un prestamo para el buro del
                              credito?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><span class="caret"><a href="#" class="ola">Reportes</a></span>
                    <ul class="nested">
                      <li><span class="caret"><a href="#" class="ola">Monitores</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-Monitor de cobradores</a></li>
                          <li><a href="#" class="ola">-Monitor del dia</a></li>
                          <li><a href="#" class="ola">-Monitor de prestamos</a></li>
                        </ul>
                      </li>

                      <li><a href="#" class="ola">-Cuadres diarios</a></li>
                      <li><a href="#" class="ola">-Reporte de cuotas vencidas</a></li>
                      <li><a href="#" class="ola">-Reporte de cuotas por zonas</a></li>
                      <li><a href="#" class="ola">-Reporte de cuotas por rutas</a></li>
                      <li><a href="#" class="ola">-Reporte de clasificacion de clientes</a></li>
                      <li><a href="#" class="ola">-Reporte de cuentas por cobrar</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="" class="ola">-¿Como cuadrar el dia?</a></li>
                          <li><a href="#" class="ola">-¿Como hacer ajustes al cuadre?</a></li>
                          <li><a href="#" class="ola">-¿Como consultar los prestamos renegociados?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <li><span class="caret"><a href="#" class="ola">Contabilidad</a></span>
                    <ul class="nested">
                      <li><a href="#" class="ola">-Conceptos</a></li>
                      <li><a href="#" class="ola">-Cheques</a></li>
                      <li><a href="#" class="ola">-Deposito</a></li>
                      <li><a href="#" class="ola">-Cargos Bancarios</a></li>
                      <li><a href="#" class="ola">-Conciliacion Bancaria</a></li>
                      <li><a href="#" class="ola">-Insertar Cargo Bancario</a></li>
                      <li><a href="#" class="ola">-Documentos de Gastos</a></li>
                      <li><a href="#" class="ola">-Pagos Administrativos</a></li>
                      <li><a href="#" class="ola">-No. Comprobante fiscal</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-¿Como consultar los beneficios de un periodo?</a></li>
                          <li><a href="#" class="ola">-¿Como hacer la reparticion de beneficios de los socios?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar los cheques?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar los depositos bancarios?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar cargos bancarios?</a></li>
                          <li><a href="#" class="ola">-¿Como registrar documentos de gastos?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><span class="caret"><a href="#" class="ola">Herramientas</a></span>
                    <ul class="nested">
                      <li><a href="#" class="ola">-Configuracion</a></li>
                      <li><a href="#" class="ola">-Impresion</a></li>
                      <li><a href="#" class="ola">-Edicion del prestamo</a></li>
                      <li><a href="#" class="ola">-Impresion del prestamo</a></li>
                      <li><a href="#" class="ola">-Cobro de cuotas</a></li>
                      <li><a href="#" class="ola">-Copia local de respaldo</a></li>

                      <li><span class="caret"><a href="#" class="ola">Calculadoras</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-Calculadora de Interes</a></li>
                          <li><a href="#" class="ola">-Calculadora de Prestamos</a></li>
                          <li><a href="#" class="ola">-Calculadora de Mora</a></li>
                          <li><a href="#" class="ola">-Calculadora de Beneficios</a></li>
                        </ul>
                      </li>

                      <li><a href="#" class="ola">-Descuentos del Prestamo</a></li>

                      <li><span class="caret"><a href="#" class="ola">¿Como?</a></span>
                        <ul class="nested">
                          <li><a href="#" class="ola">-¿Como aplicar un descuento por cuota?</a></li>
                          <li><a href="#" class="ola">-¿Como desbloquear un Prestamo?</a></li>
                          <li><a href="#" class="ola">-¿Como utilizar la calculadora de Prestamos?</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>

              <li><span class="caret"><a href="#" class="ola2">Cobros Moviles</a></span>
                <ul class="nested">
                  <li><a href="#" class="ola">-Inicio de Sesion</a></li>
                  <li><a href="#" class="ola">-Menu principal</a></li>
                  <li><a href="#" class="ola">-Pagar Cuotas</a></li>
                  <li><a href="#" class="ola">-Sincronizar</a></li>
                  <li><a href="#" class="ola">-Configuraciones</a></li>

                  <li><span class="caret"><a href="#" class="ola">Listados</a></span>
                    <ul class="nested">
                      <li><a href="#" class="ola">-Listado de Cuotas</a></li>
                      <li><a href="#" class="ola">-Listado de depositos</a></li>
                      <li><a href="#" class="ola">-Listado de Egresos</a></li>
                      <li><a href="#" class="ola">-Listado de Prestamos</a></li>
                      <li><a href="#" class="ola">-Listado de recibos cobrados</a></li>
                      <li><a href="#" class="ola">-Listado de cobros sin enviar</a></li>
                      <li><a href="#" class="ola">-Listado de cuotas en seguimiento</a></li>
                      <li><a href="#" class="ola">-Listado de solicitudes de Prestamos</a></li>
                    </ul>
                  </li>

                  <li><a href="#" class="ola">-Crear Egreso</a></li>
                  <li><a href="#" class="ola">-Crear prestamo rapido</a></li>
                  <li><a href="#" class="ola">-Cuadre resumido</a></li>
                  <li><a href="#" class="ola">-Control entrega efectivo de cobros</a></li>
                  <li><a href="#" class="ola">-Plantillas de prestamos</a></li>
                  <li><a href="#" class="ola">-Reporte de Cobros</a></li>
                  <li><a href="#" class="ola">-Seleccionar rutas</a></li>
                  <li><a href="#" class="ola">-Sincronizar cuotas</a></li>
                  <li><a href="#" class="ola">-Sincronizar Cuotas por Rango</a></li>
                  <li><a href="#" class="ola">-Tipos de pagos</a></li>
                  <li><a href="#" class="ola">-Conexiones</a></li>
                  <li><a href="#" class="ola">-Modo de Sincronizacion</a></li>
                  <li><a href="#" class="ola">-Opciones de sincronizacion</a></li>
                  <li><a href="#" class="ola">-Actualizar/Soporte</a></li>
                  <li><a href="#" class="ola">-Opciones de listado de cuotas</a></li>
                  <li><a href="#" class="ola">-Pantalla de informacion</a></li>
                  <li><a href="#" class="ola">-Seleccionar Impresora</a></li>
                </ul>
              </li>
          </li>
        </ul>
        </li>
        </ul>

        <script>
          var toggler = document.getElementsByClassName("caret");
          var i;
          
          for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
              this.parentElement.querySelector(".nested").classList.toggle("active");
              this.classList.toggle("caret-down");
            });
          }
          </script>


      </section>

      <div class="indice2">
        
      </div>
    </div>

    </body>

    <br>

    <!-- Footer -->
  <footer class="footer" >
  
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
  
      <div class="me-5 d-none d-lg-block">
        <span>Conéctate con nosotros en las redes sociales:</span>
      </div>
  
      <div>
        <a href="https://www.facebook.com/gamerasoft/" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/gamerasoftware/" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </section>
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Gamera Software
            </h6>
            <p>
              Empresa de Desarrollo de Software tanto para Windows como para Android.
            </p>
          </div>
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contáctanos</h6>
            <p><i class="fas fa-home me-3"></i> C. Proy. 3 Esq Proy. 1 #5 , Santiago de Los Caballeros</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              mayobanex@gamerasoft.com
            </p>
            <p><i class="fas fa-phone me-3"></i>809 276 2410</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
  
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:
      <a class="text-reset fw-bold" href="http://gamera.ddns.net/">Gamera Software</a>
    </div>

    <!-- Copyright -->
  </footer>
 <script src="js/buscar_.js"></script>

</html>

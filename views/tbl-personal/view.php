    <?php

    use app\assets\NpmAsset;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\DetailView;

    /** @var yii\web\View $this */
    /** @var app\models\TblPersonal $model */

    NpmAsset::register($this);


    $csfrParam = Yii::$app->request->csrfParam;
    $csfrToken = Yii::$app->request->csrfToken;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/plugin/weekday.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/plugin/customParseFormat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/plugin/isBetween.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <div class="tbl-personal-view">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');

            .noto-sans uniquifier {
                font-family: "Noto Sans", system-ui;
                font-optical-sizing: auto;
                font-variation-settings: "wdth" 100;
            }

            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 10px;
            }

            .card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 40px;
                max-width: 600px;
                margin: 0 auto;
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .card-title {
                font-size: 24px;
                color: #333;
            }

            .btn-group {
                display: flex;
                gap: 10px;
            }

            .btn {
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .btn-primary {
                background-color: #007bff;
                color: white;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
            }

            .btn:hover {
                opacity: 0.9;
            }

            .info-group {
                margin-bottom: 15px;
            }

            .info-label {
                font-weight: bold;
                color: #555;
                margin-bottom: 5px;
            }

            .info-value {
                color: #333;
            }

            .dias-disponibles {
                font-size: 18px;
                font-weight: bold;
                color: #28a745;
                margin-top: 20px;
                padding-right: 10%;
            }

            .dias-restantes {
                font-size: 18px;
                font-weight: bold;
                color: #f0361c;
                margin-top: 20px;
                padding-left: 10%;
            }

            .botonimp {
                background: #525252;
                color: white;

            }

            .underline-extend {
                position: relative;
                display: inline-block;
                padding-bottom: 2px;
                /* Ajusta este valor para cambiar la distancia entre el texto y la línea */
            }

            .underline-extend::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                height: 1px;
                /* Grosor de la línea */
                width: 100vw;
                /* Extiende la línea hasta el final de la ventana */
                background-color: black;
                /* Color de la línea */
            }


            @media print {
                .mostar {
                    display: initial;
                }

                .underline-extend::after {
                    width: 100%;
                    height: 1px;
                    background-color: black;
                }

                body {
                    font-family: Arial, sans-serif;
                    font-size: 10pt;
                    line-height: 1.3;
                    background: none;
                    color: black;
                }

                .card {
                    border: none;
                    box-shadow: none;
                    padding: 0;
                    max-width: 100%;
                }

                .card-header {
                    border-bottom: 1px solid #000;
                    padding-bottom: 10px;
                    margin-bottom: 20px;
                }

                .card-title {
                    font-size: 18pt;
                    margin-bottom: 10px;
                }

                .btn-group {
                    display: none;
                }

                .info-group {
                    margin-bottom: 10px;
                }

                .info-label {
                    font-weight: bold;
                    display: inline-block;
                    width: 200px;
                }

                .info-value {
                    display: inline-block;
                }

                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    margin: 0;
                    padding: 20px;
                }

                .container {
                    max-width: 1140px;
                    margin: 0 auto;
                    padding: 0 15px;
                    margin-top: -130px;
                }

                /* Botón de imprimir */
                .btn {
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    vertical-align: middle;
                    cursor: pointer;
                    background-color: #007bff;
                    border: 1px solid #007bff;
                    color: #fff;
                    padding: 0.375rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: 0.25rem;
                    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .d-flex {
                    display: flex;

                }

                .btn:hover {
                    background-color: #0056b3;
                    border-color: #0056b3;
                }

                .mb-4 {
                    margin-bottom: 1.5rem;
                }

                /* Encabezado con logos */
                .row {
                    display: flex;
                    flex-wrap: wrap;
                    margin-right: -15px;
                    margin-left: -15px;
                }

                .col-md-2,
                .col-md-8,
                .col-md-4,
                .col-md-6,
                .col-md-12 {
                    position: relative;
                    width: 100%;
                    padding-right: 15px;
                    padding-left: 15px;
                }

                .col-md-2 {
                    flex: 0 0 16.666667%;
                    max-width: 16.666667%;
                }

                .col-md-4 {
                    flex: 0 0 33.333333%;
                    max-width: 33.333333%;
                }

                .col-md-6 {
                    flex: 0 0 50%;
                    max-width: 50%;
                }

                .col-md-8 {
                    flex: 0 0 66.666667%;
                    max-width: 66.666667%;
                }

                .col-md-12 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                .text-center {
                    text-align: center;
                }

                .text-end {
                    text-align: right;
                }

                .logo {
                    max-width: 100px;
                    height: auto;
                }

                h5,
                h6 {
                    margin-top: 0;
                    margin-bottom: 0.5rem;
                }

                /* Formulario */
                .form-label {
                    margin-bottom: 0.5rem;
                    display: inline-block;
                }

                .form-control {
                    display: block;
                    width: 100%;
                    padding: 0.375rem 0.75rem;
                    font-size: 0.75rem;
                    line-height: 1.5;
                    color: #495057;
                    font-weight: bold;
                    border: 1px solid black;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .form-check {
                    position: relative;
                    display: block;
                    padding-left: 1.25rem;
                }

                .form-check-input {
                    position: absolute;
                    margin-top: 0.3rem;
                    margin-left: -1.25rem;
                }

                .form-check-label {
                    margin-bottom: 0;
                }

                /* Estilos adicionales */
                .mb-3 {
                    margin-bottom: 1rem;
                }

                .text-danger {
                    color: #dc3545;
                }

                .border {
                    border: 1px solid #dee2e6;
                }

                .p-2 {
                    padding: 0.5rem;
                }

                .mt-3 {
                    margin-top: 20px;
                }

                .bold {
                    font-weight: 700;
                }

                body {
                    background-color: #f8f9fa;
                }

                .form-container {
                    background-color: white;
                    border: 1px solid #dee2e6;
                    border-radius: 0.25rem;
                    padding: 20px;
                    margin-top: 20px;
                }

                .my-5 {
                    margin-top: 200px;
                    margin-bottom: 3rem;
                }

                .mb-5 {
                    margin-bottom: 3rem;
                }

                .logo {
                    max-height: 60px;
                }

                .pddingalv {
                    margin-left: 200px;
                }

                @media print {

                    .no-print {
                        display: none !important;
                    }

                }

                .dias-disponibles,
                .dias-restantes {
                    display: inline-block;
                    width: 50%;
                    margin-top: 20px;
                    font-size: 14pt;
                }


                /* Ocultar elementos innecesarios para la impresión */
                .no-print,
                .botonimp .textimp {
                    display: none;

                }
            }

            @media screen {
                .no-print {
                    display: block;
                }

                .botonimp {
                    display: block;
                }

                .textimp {
                    display: block;
                }

                img {
                    width: 100px;
                    height: 80px;
                }
            }
        </style>
        </head>

        <body>
        <div id="firstView">
            <h1 class="m-auto text-center textimp no-print"> Programa Vacacional </h1>
            <div class="card no-print">
                <div class="d-flex">

                    <img src="..\web\img.png" alt="" width="200px" height="120px">
                    <img src="..\web\img2.png" alt="" width="200px" height="140px">
                </div>
                <div class="card-header">
                    <h1 class="card-title"><?= Html::encode($model->tbl_personal_nombre) ?></h1>
                    <div class="btn-group no-print">
                        <?= Html::a('Actualizar', [
                            'update',
                            'tbl_personal_Id' => $model->tbl_personal_Id,
                            'periodo' => $model->tbl_personal_periodo,
                            'fechas' => $model->tbl_personal_fecha_inicio,
                        ], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Eliminar', null, [
                            'class' => 'btn btn-danger',
                            'onclick' => 'confirmDelete(event, ' . $model->tbl_personal_Id . ', "' . $urlToDelete . '")',
                        ]) ?>
                    </div>
                </div>
                <div class="info-group">
                    <div class="info-label">ID:</div>
                    <div class="info-value"><?= Html::encode($model->tbl_personal_Id) ?></div>

                </div>

                <!---  <div class="info-group">
                    <div class="info-label">Fecha de inicio laboral:</div>
                    <div class="info-value"><?= Html::encode($model->tbl_personal_fecha_inicio_laboral) ?></div>
                </div>
                ---->

                <div class="info-group">
                    <div class="info-label">Tipo:</div>
                    <div class="info-value"><?= Html::encode($model->tbl_personal_tipo) ?></div>
                </div>

                <div class="info-group">
                    <div class="info-label">Periodo:</div>
                    <div class="info-value">
                        <?= $Persona_periodo .' '. $Persona_año?>

                    <?= ''/*isset($obtenerperiodo[$model->tbl_personal_periodo])
                            ? $obtenerperiodo[$model->tbl_personal_periodo]
                            : 'No disponible'*/ ?>
                    </div>
                </div>

                <div class="info-group">
                    <div class="info-label">Fechas:</div>
                    <div class="info-value"><?= Html::encode($model->tbl_personal_fecha_inicio) 
                    
                    ?></div>

                </div>
                <div class="d-flex">
                            
                    <div class="dias-disponibles">
                        Días disponibles: <span
                                id="diasDisponibles">  
                                <?= $Persona_diasrestantes?> 
                            </span>
                    </div>

                    <div class="dias-restantes">
                    </div>
                    <input type="hidden" id="diasTotales"
                        value="<?= $Persona_diasrestantes?>">
                    <input type="hidden" id="fechaInicio" value="<?= Html::encode($model->tbl_personal_fecha_inicio) ?>">
                    <input type="hidden" id="fechaFinal" value="<?= Html::encode($model->tbl_personal_fecha_final) ?>">
                </div>

                        <div class="mensaje text-center mt-5 text-secondary" id="mensajevalidar">Tus vacaciones se encuentran en proceso de validacion</div>
                <input type="button" name="Submit" value="Imprimr" id="printbutton" class="botonimp btn w-25 mt-1 m-auto"
                    onclick="showPrintViewAndPrint()">
            </div>
        </div>

        </body>


        <!---Vista de la impresión del formulario de vacaciones-->

        </head>


        <body>
        <div id="printView" style="display: none;">

            <div class="container form-container">
                <button onclick="window.print()" class="btn btn-primary mb-4 no-print">Imprimir Formulario</button>

                <div class="row align-items-center mb-4">
                    <div class="col-md-2">
                        <img src="..\web\img.png" alt="Logo 1" class="logo">
                    </div>
                    <div class="col-md-8 text-center mt-3 bold">

                        <hr class="mb-5" style="border: 1, solid; margin-bottom:20px;">
                        <strong>
                            <h6 class="mb-0 mt-3">ORGANISMO PÚBLICO DESCENTRALIZADO</h6>
                            <h6>SUBDIRECCIÓN DE RECURSOS HUMANOS</h6>
                        </strong>
                    </div>
                    <div class="col-md-2 text-end">
                        <img src="..\web\img2.png" alt="Logo 2" class="logo">
                    </div>
                </div>
                <h6 class="bold"> UNIDAD ADMINISTRATIVA:
                    <t class="mx-5">Oficina Central</t>
                </h6>
                <div class="row mb-3">
                    <div class="col-md-12 text-center">
                        <h5>SOLICITUD DE VACACIONES</h5>
                    </div>
                </div>

                <form>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="nombre" class="form-label bold">NOMBRE DEL TRABAJADOR:
                            </label>

                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 1px solid black; width: calc(100% - 200px);"><?= Html::encode($model->tbl_personal_nombre) ?></span>
                        </div>
                    </div>
                    <div class="">
                        <label for="clave" class="form-label bold">CLAVE:
                        </label>
                        <span class="underline-extend text-center"
                            style="display: inline-block; border-bottom: 1px solid black; width: calc(100% - 200px);"><?= Html::encode($personal_clave) ?></span>
                    </div>

                    <div class="row">
                        <div class="">
                            <label for="puesto" class="form-label bold">PUESTO:

                            </label>
                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 1px solid black; width: calc(100% - 200px);"><?= Html::encode($personal_puesto) ?></span>
                        </div>
                        <div class="">
                            <label for="funcion" class="form-label bold">FUNCIÓN:

                            </label>
                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 1px solid black; width: calc(100% - 200px);"><?= Html::encode($personal_funcion) ?></span>
                        </div>


                        <div class="d-flex">
                            <label for="area" class="form-label bold">ÁREA:

                            </label>
                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 2px solid black; width: calc(100% - 200px);"><?= $personal_area ?></span>
                        </div>

                        <div class="d-flex">
                            <label for="departamento" class="form-label bold">DEPARTAMENTO</label>
                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 1px solid black; width: calc(100% - 200px);"><?= Html::encode($personal_dep) ?></span>
                        </div>


                        <div class="d-flex">

                            <label for="tarjeta" class="form-label bold ">NÚMERO DE TARJETA DE ASISTENCIA:</label>
                            <span class="underline-extend text-center"
                                style="display: inline-block; border-bottom: 1px solid black; width: calc(90% - 250px);"><?= $personal_tarjeta_asis ?></span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="d-flex mx-5">
                            <div class="" style="display:none">
                                <p id="jornada"> <?= $personal_jornada ?> </p>
                            </div>
                            <label class="bold mx-5">JORNADA:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="jornada1">
                                <label class="form-check-label bold" for="jornada1">DIURNA</label>
                            </div>
                            <div class="form-check mx-5">
                                <input class="form-check-input" type="checkbox" id="jornada2">
                                <label class="form-check-label bold" for="jornada2">MIXTA</label>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex mx-5 mt-5">
                        <div class="container mt-3"></div>
                        <div class="col-md-6 mt-5">
                            <div class="bold d-flex">
                                <h6>PERIODO VACACIONAL: <?= $Persona_periodo ?></h6>

                            </div>
                            <div class="container"></div>
                            <div class="col-md-16">
                                <div class="bold d-flex">
                                    <h6>PERIODO VACACIONAL: <?= $Persona_periodo ?></h6>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <p class="text-danger">NOTA: TOTAL DE DÍAS RESTAN ( <?= $Persona_diasrestantes?></span>
                                    ) DEL PERIODO
                                        ( <?= $Persona_periodo ?> )
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-5 ">
                                <div class="col-md-12">
                                    <label for="firma" class="form-label bold">FIRMA DEL TRABAJADOR:</label>
                                    <input type="text" class="form-control mb-4" id="firma">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row " style="border:3px solid black">
                        <div class="col-md-6 border p-2">
                            <p class="mb-0 text-center mt-3">NOMBRE:<strong>DR. RAMÓN ARTURO PUGA COLUMNA</p></strong>
                            <p class="mb-0">FIRMA</p>

                        </div>
                        <div class="col-md-6 border p-2 text-center">

                            <p class="mb-0  mt-3">SUBDIRECTOR DE TECNOLOGÍAS DE</p>
                            <p class="mb-0 link-opacity-100">INFORMACIÓN Y COMUNICACIONES</p>
                            <strong>
                                <p class="mb-0">CARGO</p>
                            </strong>
                        </div>

                        <div class="col-md-6 border p-2 text-center">
                            <p class="mb-0"><strong>FECHA</p></strong>
                            <p class="mb-0" id="current-date">
                                <?= date('d/m/Y') ?>
                            </p>

                        </div>
                        <div class="col-md-6 border p-2 ">
                            <p class="mb-0 text-center"><strong>PERIODO AUTORIZADO</p></strong>
                            <p class="mb-0">FECHAS: <?= Html::encode($model->tbl_personal_fecha_inicio) ?> </p>
                            <p class="mb-0">PERIODO <?= $Persona_periodo ?> </p>

                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="contenidoestadovacaciones" id="contenidoestadovacaciones">
    </div>
    <?php 
            echo "$model->estado_vacaciones	";
    ?>


    <script>
        //Funcion para calcular las vacaciones 
        function calcularDiasVacaciones() {
            let diasTotales = parseInt(document.getElementById('diasTotales').value); //Los dias totales que tiene el empleado
            var lapa = document.getElementById('fechaInicio').value; //Los dias de las vacaciones que ha tomado el empleado
            lapa = lapa.split(',') //Se separan los dias de las vacaciones en un array

            let diasDisponibles = diasTotales; //Los dias disponibles que tiene el empleado
            let diasRestantes = Math.max(diasTotales - lapa.length); //Se hace una operacion para saber cuantos dias restan

            document.getElementById('diasRestantess').textContent = diasRestantes;
            document.getElementById('diasDisponibles').textContent = diasDisponibles; //Se muestra en pantalla los dias disponibles
            document.getElementById('diasRestantes').textContent = diasRestantes; //Se muestra en pantalla los dias restantes
            let timerInterval;
            if (diasRestantes < 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes seleccionar más días de los que tienes disponibles ',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                }).then((result) => {

                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '<?= Url::to(['tbl-personal/tbl-personal'], true) ?>';
                    }
                });
            }
        }

        //funcion para validar si es posible imprimir el formulario para que la perra mamada lo desactive el boton
        const botonimprimir = document.getElementById('printbutton');
        const estado_vacaciones = document.getElementById('contenidoestadovacaciones');
        console.log(estado_vacaciones.textContent);

        if (estado_vacaciones.textContent = '') {
            printbutton.disabled = false;
        } else {
            printbutton.disabled = true;
        }



        document.addEventListener('DOMContentLoaded', calcularDiasVacaciones); //Se ejecuta la funcion al cargar la pagina
        document.getElementById('diasTotales').addEventListener('input', calcularDiasVacaciones); //Se ejecuta la funcion al cambiar el valor de los dias totales
        document.getElementById('fechaInicio').addEventListener('input', calcularDiasVacaciones); //Se ejecuta la funcion al cambiar el valor de los dias de vacaciones
        //Funcion para confirmar la eliminación 
        function confirmDelete(event, id, url) {
            event.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    //window.location.href = '<?= Yii::$app->urlManager->createUrl(["delete"]) ?>' + '&tbl_personal_Id=' + id;

                    var params = new FormData();
                    params.append('tbl_personal_Id', id);
                    params.append('<?= $csfrParam ?>', '<?= $csfrToken ?>');

                    axios.post(url, params)
                        .then(function (response) {
                            console.log(response);

                            if (response.data == true) {
                                window.location.href = '<?= Url::to(['tbl-personal/tbl-personal'], true) ?>';
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
        }

        //Funcion para seleccionar la jornada
        const jor = document.getElementById('jornada')
        if (jor.textContent == 0) {
            document.getElementById('jornada1').checked = true
        } else {
            document.getElementById('jornada2').checked = true
        }


        function showPrintViewAndPrint() {
            document.getElementById('firstView').style.display = 'none';
            document.getElementById('printView').style.display = 'block';
            setTimeout(() => {
                window.print();
            }, 100);
        }



        // Detectar cuando se cancela o termina la impresión
        window.onafterprint = function () {
            document.getElementById('firstView').style.display = 'block';
            document.getElementById('printView').style.display = 'none';
        };

        // Detectar cuando se cancela la impresión
        window.onafterprint = hidePrintView;



      

    </script>


    <?php
    $js = <<<JS

        
    JS;

    $this->registerJs($js);
    ?>
    </div>
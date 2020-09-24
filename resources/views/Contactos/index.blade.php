@extends('layouts.app',['pageSlug' => 'dashboard'])

@section('content')

<div class="container">
    <!-- Mostrar mensaje si se modifico o se agrego un nuevo contacto -->
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('Mensaje') }}
    </div>
</div>
@endif


<a href=" {{ url('Contactos/create') }} " class="btn blue-gradient">Agregar Contacto</a>
<br />
<br />
<div class="card">
    <div class="card-body">
        <canvas id="barChart" height="300"></canvas>
    </div>
</div>
<br />
<!-- Tabla para mostrar los datos de los contactos -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Comentario</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Funcion para repetir para todos los contactos que se obtengan de la base de datos -->
                    @foreach($contactos as $contacto)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            <img src="{{asset('storage').'/'.$contacto->Foto }} " class="img-thumbnail img-fluid" width="100">
                        </td>
                        <td> {{ $contacto->Nombre }} </td>
                        <td> {{ $contacto->Apellido }} </td>
                        <td> {{ $contacto->Celular }} </td>
                        <td> {{ $contacto->Correo }} </td>
                        <td> {{ $contacto->Comentario }} </td>
                        <td> {{ $contacto->Edad }} </td>
                        <td> {{ $contacto->Genero }} </td>
                        <td class="td-actions text-right">
                            <a rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon" href=" {{ url('/Contactos/'.$contacto->id.'/edit') }}">
                                <i class="tim-icons icon-settings"></i>
                            </a>
                            <form method="post" action="{{ url('/Contactos/'.$contacto->id) }}" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" type="submit" onclick="return confirm('Borrar?');">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <canvas id="genderChart"></canvas>
    </div>
</div>
<script>
    /* Creacion de Graficas, agregando los datos  */
    var edad = [];
    var nombres = [];
    var genero = [0, 0];
    /* For each para llenar los array con los datos de los contactos de la pagina actual */
    @foreach($contactos as $contacto)
    edad.push("{{$contacto->Edad}}");
    nombres.push("{{$contacto->Nombre}}")
    if ("{{$contacto->Genero == 'Masculino'}}") {
        genero[0] = genero[0] + 1;
    } else {
        if ("{{$contacto->Genero == 'Femenino'}}") {
            genero[1] = genero[1] + 1;
        }
    }
    @endforeach
    var ctxB = document.getElementById("barChart").getContext('2d');
    /* Primera grafica de edades */
    var ctx = document.getElementById("barChart").getContext('2d');

    /* Creacion del gradiente de fondo para la grafica 1 */
    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
    gradientChartOptionsConfiguration = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },

        tooltips: {
            backgroundColor: '#fff',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.0)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    suggestedMin: 50,
                    suggestedMax: 110,
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
            }],

            xAxes: [{
                barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(220,53,69,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
            }]
        }
    };



    gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

    /* Asignando los datos a la variable de data */
    var data = {
        labels: nombres,
        datasets: [{
            label: "Edad",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor: 'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: edad,
        }]
    };

    /* Creacion de Grafica de linea */
    var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: gradientChartOptionsConfiguration
    });
    /* Segunda grafica de Genero */
    new Chart(document.getElementById("genderChart"), {
        "type": "horizontalBar",
        "data": {
            "labels": ["Hombres", "Mujeres"],
            "datasets": [{
                "label": "Genero",
                "data": genero,
                "fill": false,
                "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                    "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                    "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                ],
                "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                ],
                "borderWidth": 1
            }]
        },
        "options": {
            "scales": {
                "xAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            }
        }
    });
</script>
<!-- Links para la paginacion -->
{{ $contactos->links() }}

</div>

@endsection
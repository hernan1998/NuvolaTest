<?php

namespace App\Http\Controllers;

use App\Models\Contactos;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* Paginacion para la vista principal */
        $datos['contactos'] = Contactos::simplePaginate(50);

        return view('Contactos.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /* Develve la vista agregar nuevo contacto */
        return view('Contactos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        /* Campos que se van a validar  */
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Celular' => 'required|numeric',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            'Edad' => 'required|numeric|min:1|max:100',
            'Genero' => 'required|string|max:100',
        ];
        /* Mensajes a mostrar si algun campo no esta validado */
        $Mensaje = ["required" => 'El :attribute es incorrecto o esta vacio'];

        /* Funcion Validar campos */
        $this->validate($request, $campos, $Mensaje);


        /* Excluir los datos de tokon los datos del contacto */
        $datosContacto = request()->except('_token');

        /* Validar si se subio una foto, si es TRUE -> Subir la foto en la base de datos */
        if ($request->hasFile('Foto')) {
            $datosContacto['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        /* Agregar los datos del usuario en la base de datos */
        Contactos::insert($datosContacto);
        return redirect('Contactos')->with('Mensaje', 'Nuevo Contacto agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contactos  $contactos
     * @return \Illuminate\Http\Response
     */
    public function show(Contactos $contactos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contactos  $contactos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        /* Extraer la informacion del contacto y enviarla a la vista de Editar */
        $contacto = Contactos::findOrFail($id);
        return view('Contactos.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contactos  $contactos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        /* Campos que se van a validar  */
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Celular' => 'required|numeric',
            'Correo' => 'required|email',
            'Edad' => 'required|numeric|min:1|max:100',
            'Genero' => 'required|string|max:100',
        ];

        /* Validar si se modifico la foto */
        if ($request->hasFile('Foto')) {
            $campos += ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
        }

        /* Mensajes a mostrar si algun campo no esta validado */
        $Mensaje = ["required" => 'El :attribute es incorrecto o esta vacio'];

        /* Funcion Validar campos */
        $this->validate($request, $campos, $Mensaje);

        /* Excluir los datos de tokon y method los datos del contacto */
        $datosContacto = request()->except(['_token', '_method']);

        /* Validar si hay una foto -> se agrego una nueva foto */
        if ($request->hasFile('Foto')) {
            $contacto = Contactos::findOrFail($id);
            /* SI se agrego una foto -> Eliminar la foto anterior para luego agregar la nueva */
            Storage::delete('public/' . $contacto->Foto);
            $datosContacto['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        /* Funcion para hacer el update a la base de datos */
        Contactos::where('id', '=', $id)->update($datosContacto);

        /* Redireccionar a la vista principal cuando se modifica con exito el contacto */
        return redirect('Contactos')->with('Mensaje', 'Contacto Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contactos  $contactos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        /* Obtener la informacion del contacto */
        $contacto = Contactos::findOrFail($id);
        /* Si el contacto tiene una foto -> borrarla de la base de datos */
        if (Storage::delete('public/' . $contacto->Foto)) {
            Contactos::destroy($id);
        }
        /* Redireccionar a la pagina principal con el mensade de confirmacion de eliminado  */
        return redirect('Contactos')->with('Mensaje', 'Contacto Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Http\Requests\CreateMedicamento;
class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $sortField = $request->input('sort', 'id');
    $sortDirection = $request->input('direction', 'asc');

    $medicamentos = Medicamento::orderBy($sortField, $sortDirection)->get();

    return view('medicamento.medicamentos', [
        'medicamentos' => $medicamentos,
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'buscar' => '',
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('medicamento.form', ['medicamento' => new Medicamento()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMedicamento $request)
    {
         $request->validate([
        'nombre' => 'required|string',
        'marca' => 'required|string',
        'laboratorio' => 'required|string',
        'dosis' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $medicamentos=new Medicamento();
        $medicamentos->nombre=$request->get('nombre');
        $medicamentos->marca=$request->get('marca');
        $medicamentos->laboratorio=$request->get('laboratorio');
        $medicamentos->dosis=$request->get('dosis');
        
        
          if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes'), $nombre); // lo guarda en /public/imagenes
        $medicamentos->imagen = $nombre;
    }
        $medicamentos->save();//se usa eloquent
        return redirect('/medicamentos')->with('status', 'Medicamento agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $medicamento=Medicamento::find($id);
        return view('medicamento.form')->with('medicamento',$medicamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMedicamento $request, $id)
    {
         $medicamento = Medicamento::find($id);
        $medicamento->nombre=$request->get('nombre');
        $medicamento->marca=$request->get('marca');
        $medicamento->laboratorio=$request->get('laboratorio');
        $medicamento->dosis=$request->get('dosis');  
         if ($request->hasFile('imagen')) {
        // Eliminar la imagen antigua (si existe)
        if ($medicamento->imagen && file_exists(public_path('imagenes/'.$medicamento->imagen))) {
            unlink(public_path('imagenes/'.$medicamento->imagen));  // Elimina la imagen vieja
        }

        // Subir la nueva imagen
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes'), $nombre);

        // Guardar el nombre de la nueva imagen
        $medicamento->imagen = $nombre;
    }     
        $medicamento->save();//se usa eloquent
        return redirect('/medicamentos')->with('status', 'Medicamento modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
       $medicamento->delete();//se usa eloquent
       return redirect('/medicamentos')->with('status', 'Medicamento eliminado con éxito');
    }
    public function buscar(Request $request)
{
    
    $query = $request->input('buscar');
    $sortField = $request->input('sort', 'id'); 
    $sortDirection = $request->input('direction', 'asc'); 

 
    $medicamentos = Medicamento::query();

    // filtra por marca laboratorio
    if (!empty($query)) {
        $medicamentos->where(function($q) use ($query) {
            $q->where('marca', 'LIKE', "%{$query}%")
              ->orWhere('laboratorio', 'LIKE', "%{$query}%");
        });
    }

    //ordenamiento
    $medicamentos = $medicamentos->orderBy($sortField, $sortDirection)->get();

    
    return view('medicamento.medicamentos', [
        'medicamentos' => $medicamentos,
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'buscar' => $query,
    ]);
}

}

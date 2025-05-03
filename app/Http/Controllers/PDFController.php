<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Usuario;
use App\Repositories\FichaVehiculoRepository;
use Barryvdh\DomPDF\Facade\Pdf;


class PDFController extends Controller
{
    protected $fichaVehiculoRepository;
    public function __construct(FichaVehiculoRepository $fichaVehiculoRepository)
    {
        $this->fichaVehiculoRepository = $fichaVehiculoRepository;
    }

    public function generarPDF(Request $request)
    {
        $request->validate([
            'funcion' => 'required|string',
            'params' => 'nullable|string',
            'tipo' => 'required|string|in:pdf,excel',
            'custom_title' => 'nullable|string',
        ]);

        $funcion = $request->input('funcion');
        $paramsString = $request->input('params');
        $tipo = $request->input('tipo');
        $titulo = $request->input('custom_title', 'Reporte');
        $version = $request->input('version', 'v1');

        $params = $this->parseParams($paramsString);

        // Validar que el método exista
        if (!method_exists($this, $funcion)) {
            return response()->json(['error' => 'Función no válida'], 400);
        }

        // Ejecutar función con parámetros
        $datos = $this->$funcion($params);

        // Vista deducida automáticamente
        $vista = 'pdf.' . $funcion;

        $variables = [
            'datos' => $datos,
            'titulo' => $titulo,
            'params' => $params,
            'fecha' => now()->format('d/m/Y'),
            'version' => $version
        ];

        if ($tipo === 'pdf') {
            $pdf = Pdf::loadView($vista, $variables);
            return $pdf->download("{$titulo}.pdf");
        }

        return response()->json(['error' => 'Tipo no soportado aún'], 400);
    }

    private function parseParams($paramsString)
    {
        $result = [];

        if (!$paramsString) return $result;

        $pairs = explode('|', $paramsString);
        foreach ($pairs as $pair) {
            [$key, $value] = explode('^', $pair) + [null, null];
            if ($key) $result[$key] = $value;
        }

        return $result;
    }

    // 🔽 Ejemplo de función dinámica
    private function getFichaTecnica($params)
    {
        $ficha_vehicular_id = $params['ficha_vehicular_id'] ?? null;

        // Asegúrate de tener una instancia del repositorio
        return $this->fichaVehiculoRepository->show($ficha_vehicular_id);
    }

}

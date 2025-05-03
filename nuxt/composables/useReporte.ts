export default function useFichaVehicular(){

    const api = useApiEntity('/api/reporte');

    return {
        'generarReporteUsuariosPorAccion': api.generarReportePdf,
    }
}


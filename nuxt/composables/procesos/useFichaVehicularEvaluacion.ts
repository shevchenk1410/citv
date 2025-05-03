export default function useFichaVehicularEvaluacion(){

    const api = useApiEntity('/api/fichas-vehiculares-elavuacion');

    return {
        'createFichaVehicularEva': api.createEntity,
        'updateFichaVehicularEva': api.updateEntity,
        'getFichaVehicularEvaId': api.getEntityById,
    }
}


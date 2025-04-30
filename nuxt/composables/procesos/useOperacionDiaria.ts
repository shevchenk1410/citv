export default function useOperacionDiaria(){
    
    const api = useApiEntity('/api/operaciones-diarias');

    return {
        'createOperacionDiaria': api.createEntity,
        'getOperacionesDiarias': api.getEntities,
        'updateOperacionDiariaState': api.updateEntityState,
        'updateOperacionDiaria': api.updateEntity
    }
}


export default function useTipoAmbito(){
    
    const api = useApiEntity('/api/tipos-ambitos');

    return {
        'createTipoAmbito': api.createEntity,
        'getTiposAmbitos': api.getEntities,
        'updateTipoAmbitoState': api.updateEntityState,
        'updateTipoAmbito': api.updateEntity
    }
}


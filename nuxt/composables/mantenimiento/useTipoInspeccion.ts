export default function useTipoInspeccion(){
    
    const api = useApiEntity('/api/tipos-inspecciones');

    return {
        'createTipoInspeccion': api.createEntity,
        'getTiposInspecciones': api.getEntities,
        'updateTipoInspeccionState': api.updateEntityState,
        'updateTipoInspeccion': api.updateEntity
    }
}


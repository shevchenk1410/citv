export default function useTipoServicio(){
    
    const api = useApiEntity('/api/tipos-servicios');

    return {
        'createTipoServicio': api.createEntity,
        'getTiposServicios': api.getEntities,
        'updateTipoServicioState': api.updateEntityState,
        'updateTipoServicio': api.updateEntity
    }
}
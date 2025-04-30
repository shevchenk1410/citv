export default function useSucursal(){

    const api = useApiEntity('/api/sucursales');

    return {
        'createSucursal': api.createEntity,
        'getSucursales': api.getEntities,
        'updateSucursalState': api.updateEntityState,
        'updateSucursal': api.updateEntity
    }
}
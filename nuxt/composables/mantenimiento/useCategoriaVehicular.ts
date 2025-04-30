export default function useTipoAmbito(){
    
    const api = useApiEntity('/api/categorias-vehiculares');

    return {
        'getCategoriasVehiculares': api.getEntities,
        'createCategoriaVehicular': api.createEntity,
        'updateCategoriaVehicularState': api.updateEntityState,
        'updateCategoriaVehicular': api.updateEntity
    }
}


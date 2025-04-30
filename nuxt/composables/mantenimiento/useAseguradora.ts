export default function useAseguradora(){
    
    const api = useApiEntity('/api/aseguradoras');

    return {
        'createAseguradora': api.createEntity,
        'getAseguradoras': api.getEntities,
        'updateAseguradoraState': api.updateEntityState,
        'updateAseguradora': api.updateEntity
    }
}


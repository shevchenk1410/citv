export default function useFichaVehicular(){

    const api = useApiEntity('/api/fichas-vehiculares');

    return {
        'createFichaVehicular': api.createEntity,
        'getFichasVehiculares': api.getEntities,
        'updateFichaVehicularState': api.updateEntityState,
        'updateFichaVehicular': api.updateEntity,
        'updatePoliza': api.updateEntityPoliza,
        'getFichaVehicularId': api.getEntityById,
    }
}


export default function useRol(){
    const api = useApiEntity('/api/roles');

    return {
        'getRoles': api.getEntities,
        'createRol': api.createEntity,
        'updateRolState': api.updateEntityState,
        'updateRol': api.updateEntity,
        'updateMenu': api.updateEntityMenu
    }
}


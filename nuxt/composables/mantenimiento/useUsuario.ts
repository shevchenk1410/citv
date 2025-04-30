export default function useUsuario(){

    const api = useApiEntity('/api/usuarios');

    return {
        'getUsuarios': api.getEntities,
        'createUsuario': api.createEntity,
        'updateUsuarioState': api.updateEntityState,
        'updateUsuario': api.updateEntity
    }
}
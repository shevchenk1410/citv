export default function useCliente(){
    
    const api = useApiEntity('/api/clientes');

    return {
        'getClientes': api.getEntities,
        'createCliente': api.createEntity,
        'updateClienteState': api.updateEntityState,
        'updateCliente': api.updateEntity
    }
}
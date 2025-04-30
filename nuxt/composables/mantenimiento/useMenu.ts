export default function useMenu(){
    
    const api = useApiEntity('/api/menus');

    return {
        'createMenu': api.createEntity,
        'getMenus': api.getEntities,
        'updateMenuState': api.updateEntityState,
        'updateMenu': api.updateEntity
    }
}


export default defineNuxtRouteMiddleware((to, from)=>{

    const user = useSanctumUser();
    const _menu = [];
    
    user.value.rol.menus.forEach((menu)=>{
        if(menu.url !== '#')
            _menu.push(menu.url);
        if(menu?.menus.length > 0){
            menu.menus.forEach(submenu=>{
                _menu.push(submenu.url);
            });
        }
    });

    if(_menu.includes(to.path)){
        return;
    }

    return navigateTo('/')
});
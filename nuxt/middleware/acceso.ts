export default defineNuxtRouteMiddleware((to, from) => {
    const user = useSanctumUser();
    const _menu = [];

    user.value.rol.menus.forEach((menu) => {
      if (menu.url !== '#') _menu.push(menu.url);
      if (menu?.menus.length > 0) {
        menu.menus.forEach((submenu) => {
          _menu.push(submenu.url);
        });
      }
    });

    const isAuthorized = _menu.some((menuUrl) =>
      to.path === menuUrl || to.path.startsWith(menuUrl + '/')
    );

    if (!isAuthorized) {
      return navigateTo('/');
    }
  });

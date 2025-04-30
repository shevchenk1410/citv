<script setup lang="ts">

const { layoutConfig, layoutState, isSidebarActive, resetMenu } = useLayout();

const outsideClickListener:any = ref(null);

watch(isSidebarActive, (newVal:any) => {
    if (newVal) {
        bindOutsideClickListener();
    } else {
        unbindOutsideClickListener();
    }
});

const containerClass = computed(() => {
    return {
        'layout-overlay': layoutConfig.menuMode === 'overlay',
        'layout-static': layoutConfig.menuMode === 'static',
        'layout-static-inactive': layoutState.staticMenuDesktopInactive && layoutConfig.menuMode === 'static',
        'layout-overlay-active': layoutState.overlayMenuActive,
        'layout-mobile-active': layoutState.staticMenuMobileActive
    };
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event:any) => {
            if (isOutsideClicked(event)) {
                resetMenu();
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
}

const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener.value);
        outsideClickListener.value = null;
    }
}

const isOutsideClicked = (event:any) => {
    const sidebarEl = document.querySelector('.layout-sidebar');
    const topbarEl = document.querySelector('.layout-menu-button');

    return !(sidebarEl?.isSameNode(event.target) || sidebarEl?.contains(event.target) || topbarEl?.isSameNode(event.target) || topbarEl?.contains(event.target));
}

</script>
<template>
    <div class="layout-wrapper" :class="containerClass">
        <AppTopbar></AppTopbar>
        <AppSidebar></AppSidebar>
        <div class="layout-main-container">
            <div class="layout-main">
                <slot></slot>
            </div>
            <AppFooter></AppFooter>
        </div>
        <DynamicDialog />
    </div>
</template>
<script src="/vendor/jquery.min.js"></script>
<script src="/vendor/bootstrap.bundle.min.js"></script>
<script src="/vendor/simplebar.min.js"></script>
<script src="/vendor/sweetalert2.all.min.js"></script>
<script src="/build/js/layout.js"></script>
<script src="/build/js/app.js"></script>
@livewireScripts
<script>
    document.addEventListener('livewire:init', ()=>{
        Livewire.on('close-modal', (event)=>{
            $('#' + event[0]).modal('hide');
        });7

        Livewire.on('open-modal', (event)=>{
            $('#' + event[0]).modal('show');
        });

        Livewire.on('delete', (e)=>{
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(e.eventName, {id: e.id});
                }
            });
        });

        Livewire.on('msg', (e)=>{
            Swal.fire({
                title: 'Éxito',
                text: e[0],
                icon: 'success'
            });
        });

        Livewire.on('msg-error', (e)=>{
            Swal.fire({
                title: 'Error',
                text: e[0],
                icon: 'error'
            });
        });

        Livewire.on('open-new-tab', (e)=>{
            window.open(e[0], '_blank');
        });
    });
</script>
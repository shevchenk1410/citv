<template>
      <div>
        <div class="p-d-flex p-ai-center p-jc-center mb-6">
          <i class="pi pi-exclamation-triangle p-mr-3" style="font-size: 4rem;"></i>
        </div>
        <p class="mb-6 text-xl">{{ errorMessage }}</p>
        <div class="flex justify-end">
            <Button type="button" text severity="danger" label="Cerrar" @click="dialogRef.close()"></Button>
        </div>
    </div>
</template>

<script setup lang="ts">
  const dialogRef:any = inject('dialogRef');
  const errorMessage = ref('');

  onMounted(() => {
    const modalParams = dialogRef.value.data;
    errorMessage.value = modalParams.errorMessage;
  });
</script>

<style scoped>
.p-d-flex {
  display: flex;
}
.p-ai-center {
  align-items: center;
}
.p-jc-center {
  justify-content: center;
}
</style>

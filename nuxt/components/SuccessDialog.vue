<template>
    <div>
      <div class="p-d-flex p-ai-center p-jc-center mb-10">
        <i class="pi pi-check-circle p-mr-3 text-green-700" style="font-size: 5rem;"></i>
      </div>
      <p class="mb-10 text-xl">{{ successMessage }}</p>
      <div class="flex justify-end">
          <Button type="button" text severiry="primary" label="Aceptar" @click="dialogRef.close()"></Button>
      </div>
  </div>
</template>

<script setup lang="ts">
const dialogRef:any = inject('dialogRef');
const successMessage = ref('');

onMounted(() => {
  const modalParams = dialogRef.value.data;
  successMessage.value = modalParams.successMessage;
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

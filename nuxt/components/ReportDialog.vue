<template>
    <iframe
        id="popup-report"
        src=""
        style="width: 100%; height: calc(95vh - 140px); border: none;">
    </iframe>
  </template>

  <script setup lang="ts">
  const dialogRef:any = inject('dialogRef');

  onMounted(() => {
    const iframe: HTMLIFrameElement = (<HTMLIFrameElement>document.getElementById('popup-report'));
    iframe.src = dialogRef.value.data.fileURL;
  });
  </script>

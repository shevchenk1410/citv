import SuccessDialog from "~/components/SuccessDialog";
export const useSuccessHandler = () => {
  const dialog = useDialog(); // Servicio de PrimeVue para abrir diálogos

  const handleSuccess = (message: any) => {
    dialog.open(SuccessDialog, {
      props: {
        header: 'Éxito',
        modal: true,
      },
      data: {
        successMessage: message
      }
    });
  };

  return {
    handleSuccess,
  };
};

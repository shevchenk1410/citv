import ErrorDialog from "~/components/ErrorDialog";
export const useErrorHandler = () => {
  const dialog = useDialog(); // Servicio de PrimeVue para abrir diálogos

  const handleError = (error: any, showMessageDialogError: boolean = false) => {
    let requestId = '';
    let errorMessage = '';
    if (error.response) {
        requestId = error.response.headers.get('request-id');
        errorMessage = error.response._data?.message || error.response.statusText;
    } else {
        errorMessage = error ?? 'Origen desconocido';
    }

    dialog.open(ErrorDialog, {
      props: {
        header: 'Error',
        modal: true,
      },
      data: {
        requestId,
        errorMessage,
        showMessageDialogError,
      }
    });
    throw error;
  };

  return {
    handleError,
  };
};

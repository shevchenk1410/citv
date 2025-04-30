import ErrorDialog from "~/components/ErrorDialog";
export const useErrorHandler = () => {
  const dialog = useDialog(); // Servicio de PrimeVue para abrir diálogos

  const handleError = (error: any) => {
    dialog.open(ErrorDialog, {
      props: {
        header: 'Error',
        modal: true,
      },
      data: {
        errorMessage: error.response._data.message ?? 'Error desconocido',
      }
    });

    // devolvemos el error para que el componente que lo llamó pueda hacer
    // algo más con él si lo necesita
    throw error;
  };

  return {
    handleError,
  };
};

import ReportDialog from '@/components/ReportDialog.vue';

export const useReportHandler = () => {
  const dialog = useDialog();

  const handleReport = (fileURL: any) => {
    dialog.open(ReportDialog, {
      props: {
        header: 'Reporte',
        modal: true,
        maximizable: true,
        style: {
          width: '90vw',
        },
      },
      data: { fileURL }
    });
  };

  return {
    handleReport,
  };
};

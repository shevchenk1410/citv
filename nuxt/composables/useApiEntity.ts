export default function useApiEntity(endpoint: string) {
    const client = useSanctumClient();
    const config = useRuntimeConfig();
    const { handleError } = useErrorHandler();

    const baseURL = config.public.apiUrl;
    const apiEndpoint = `${baseURL}${endpoint}`;

    const getEntities = async (params: Record<string, any>) => {
        return await client(apiEndpoint, { params });
    };

    const createEntity = async (data: Record<string, any>) => {
        try {
            return await client(apiEndpoint, {
                method: 'POST',
                body: data
            });
        } catch (error: any) {
            handleError(error);
        }
    };

    const updateEntityState = async (id: number) => {
        try {
            return await client(`${apiEndpoint}/${id}/estado`, {
                method: 'PATCH',
            });
        } catch (error: any) {
            handleError(error);
        }
    };

    const updateEntity = async (id: number, data: Record<string, any>) => {
        try {
            return await client(`${apiEndpoint}/${id}`, {
                method: 'PUT',
                body: data
            });
        } catch (error: any) {
            handleError(error);
        }
    };

    const updateEntityMenu = async (id: number, data: Record<string, any>) => {
        try {
            return await client(`${apiEndpoint}/${id}/menu`, {
                method: 'PUT',
                body: data
            });
        } catch (error: any) {
            handleError(error);
        }
    }

    const updateEntityPoliza = async (id: number, data: Record<string, any>) => {
        try {
            return await client(`${apiEndpoint}/${id}/poliza`, {
                method: 'PATCH',
                body: data
            });
        } catch (error: any) {
            handleError(error);
        }
    }

    return {
        getEntities,
        createEntity,
        updateEntityState,
        updateEntity,
        updateEntityMenu,
        updateEntityPoliza,
    };
}

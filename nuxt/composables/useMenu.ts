export default function useMenu(){
    
    const config = useRuntimeConfig();
    const endpoint:string = '/api/menu';

    const getLink = async () => {
        console.log(`${config.public.apiUrl}${endpoint}`);
        return await $fetch(`${config.public.apiUrl}${endpoint}`, {
            method: 'GET',
            credentials: 'include',
        });
    }

    return { getLink };
}
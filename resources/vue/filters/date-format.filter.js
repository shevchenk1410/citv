import dayjs from 'dayjs';

export function dateFormat(date, format = 'DD/MM/YYYY') {
    return dayjs(date).format(format);
}
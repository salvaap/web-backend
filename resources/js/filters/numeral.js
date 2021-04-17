export function currency(value) {
    return numeral(value).format('0,0[.]00');
}
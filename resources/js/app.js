require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';



import PrimeVue from 'primevue/config';
import FullCalendar from 'primevue/fullcalendar';
import '@/Themes/theme.css';   // theme
//import 'primevue/resources/themes/mytheme/theme.css';
import 'primevue/resources/primevue.min.css';             // core css
import 'primeicons/primeicons.css';                       // icons


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(PrimeVue, { ripple: true }, {
                locale: {
                  startsWith: 'Starts with',
                  contains: 'Contains',
                  notContains: 'Not contains',
                  endsWith: 'Ends with',
                  equals: 'Equals',
                  notEquals: 'Not equals',
                  noFilter: 'No Filter',
                  lt: 'Less than',
                  lte: 'Less than or equal to',
                  gt: 'Greater than',
                  gte: 'Greater than or equal to',
                  dateIs: 'Date is',
                  dateIsNot: 'Date is not',
                  dateBefore: 'Date is before',
                  dateAfter: 'Date is after',
                  clear: 'ล้างข้อมูล',
                  apply: 'Apply',
                  matchAll: 'Match All',
                  matchAny: 'Match Any',
                  addRule: 'Add Rule',
                  removeRule: 'Remove Rule',
                  accept: 'Yes',
                  reject: 'No',
                  choose: 'Choose',
                  upload: 'Upload',
                  cancel: 'Cancel',
                  dayNames: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
                  dayNamesShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
                  dayNamesMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
                  monthNames: ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
                  monthNamesShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.","ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
                  today: 'วันนี้',
                  weekHeader: 'Wk',
                  firstDayOfWeek: 0,
                  dateFormat: 'dd/mm/yy',
                  weak: 'Weak',
                  medium: 'Medium',
                  strong: 'Strong',
                  passwordPrompt: 'Enter a password',
                  emptyFilterMessage: 'No results found',
                  emptyMessage: 'No available options'
                },
            })
            .component('FullCalendar', FullCalendar)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });

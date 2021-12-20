require('./bootstrap');


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';



//import PrimeVue from 'primevue/config';
//import FullCalendar from 'primevue/fullcalendar';
import '@/Themes/theme.css';   // theme
//import 'primevue/resources/themes/mytheme/theme.css';
//import 'primevue/resources/primevue.min.css';             // core css
//import 'primeicons/primeicons.css';                       // icons


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });

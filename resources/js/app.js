import '../css/app.css';

import { createApp, h } from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueDragscroll from "vue-dragscroll";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Расписание занятий, колледж программирования и кибербезопасности';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)
            .use(VueDragscroll)
            .mixin( { methods: { route }})
            .mount(el)
    },
});


InertiaProgress.init({ color: '#4B5563' });

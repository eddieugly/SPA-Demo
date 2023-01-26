import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import Layout from './Shared/Layout'

createInertiaApp({
  progress: {

    // The color of the progress bar.
    color: 'red',

  
  },
  resolve: async name => {
    let page = (await import(`./Pages/${name}.vue`)).default;
    page.layout ??= Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link, "Head", Head)
      .mount(el)
  },
});
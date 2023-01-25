import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'

createInertiaApp({
  progress: {

    // The color of the progress bar.
    color: 'red',

  
  },
  resolve: name => require(`./Pages/${name}.vue`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component(Link, Link)
      .mount(el)
  },
});
<template>

  <Head>
    <title>
      My App - {{ pagename }}
    </title>
    <meta name="description" content="Modern App with Laravel, InertiaJs, VueJs & TailWind" head-key="description">
  </Head>
  <section class="p-6 bg-gray-200">
    <header class="flex justify-between">
      <Div class="flex items-center">
        <h1 class="font-bold text-lg">
          My App
        </h1>
        <p class="text-sm ml-4">
          Welcome Back! {{ username }}
        </p>
      </Div>
      <Nav />
    </header>
    
  </section>
  <flash-messages />
  <section class="p-6">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>


</template>

<script>
import Nav from './Nav';
import FlashMessages from './FlashMessages';
import { Head } from '@inertiajs/vue3';
export default {
  components: { Nav, Head, FlashMessages },
  computed: {
    username() {
      return this.$page.props.auth.user.username;
    },
    pagename() {
      return this.$page.component;
    }
  },
  props: {
    auth: Object,
  }
};
</script>
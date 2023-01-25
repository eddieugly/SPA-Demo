<template lang="">
        <h1 class="text-4xl font-bold">
            Users
        </h1>
        <div style="margin-top: 800px">
            <p>The current time is {{ time }}</p>
            <Link href='/users' class="text-blue-500 hover:underline" preserve-scroll>Refresh</Link>
        </div>
    
</template>
<script setup>

import Layout from '../Shared/Layout';
import { Link } from '@inertiajs/vue3';

defineProps({
    time: String
});
</script>
<script>
export default {
  layout: Layout
};
</script>

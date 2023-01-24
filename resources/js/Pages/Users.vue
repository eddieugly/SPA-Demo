<template lang="">
    <h1 class="text-4xl font-bold">Users</h1>
    
    <Nav />

    <div>
        <p>The current time is {{ time }}</p>
    </div>
</template>
<script>

import Nav from '../Shared/Nav';

export default {
    components: { Nav },

    props: { time : String}
}
</script>

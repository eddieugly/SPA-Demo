<template lang="">
        <h1 class="text-4xl font-bold">
            Users
        </h1>
        <div style="">
            <ul>
                <li v-for="user in users" :key="user.id" v-text="user.name"></li>
            </ul>
        </div>
    
</template>
<script setup>
defineProps({
    users: Array
});
</script>



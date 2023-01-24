<template>
    <div>
        <nav class="mt-6">
            <ul class="list-disc">
                <li><Link href="/" class="text-blue-500 hover:underline">Home</Link></li>
                <li><Link href="/users" class="text-blue-500 hover:underline">Users</Link></li>
                <li><Link href="/settings" class="text-blue-500 hover:underline">Settings</Link></li>
                <li><Link href="/logout" as="button" method="post" :data="{foo: 'bar'}" class="text-blue-500 hover:underline">Logout</Link></li>
            </ul>
        </nav>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
};
</script>
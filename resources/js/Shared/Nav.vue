<template>
    <div>
        <nav>
            <ul class="flex space-x-6">
                <li>
                    <NavLink href="/" :active="$page.component === 'Home'">
                        Home
                    </NavLink>
                </li>
                <li>
                    <NavLink href="/users" :active="$page.component === 'Users/Index'">
                        Users
                    </NavLink>
                </li>
                <li>
                    <NavLink href="/settings" :active="$page.component === 'Settings'">
                        Settings
                    </NavLink>
                </li>
                <li>
                    <NavLink href="/logout" method="post" as="button">
                        Logout
                    </NavLink>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
import NavLink from './NavLink';

export default {
    components: { NavLink },
};
</script>
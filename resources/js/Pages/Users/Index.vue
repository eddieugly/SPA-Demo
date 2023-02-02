<template lang="">
        <div class="flex justify-between">
            <div class="flex items-center">
            <h1 class="text-3xl">
            Users
            </h1>
              <Link v-if="can.createUser" href="/users/create" @method="button" class="bg-blue-800 rounded-md text-white p-1 ml-5">
                Create Users
              </Link>
            </div>
            <input class="border px-2 rounded-lg" v-model="search" type="text" name="" placeholder="Search...">
        </div>
        <!-- component -->
<div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
  <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
      <tr class="hover:bg-gray-50" v-for="user in users.data" :key="user.id">
        <th class="flex px-6 py-4 font-normal text-gray-900">
          <div class="text-sm">
            <div class="font-medium text-gray-700">{{ user.name }}</div>
            <div class="text-gray-400">{{ user.email }}</div>
          </div>
        </th>
        <td class="px-6 py-4">
          <div class="flex justify-end gap-4">
            <Link v-if="user.can.delete" x-data="{ tooltip: 'Delete' }" method="delete" as="button" :href="'/users/' + user.id + '/destroy'">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6"
                x-tooltip="tooltip"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                />
              </svg>
            </Link>
            <Link v-if="user.can.edit" x-data="{ tooltip: 'Edit' }" :href="'/users/' + user.id + '/edit'">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-6 w-6"
                x-tooltip="tooltip"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                />
              </svg>
            </Link>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Paginator -->
<Pagination class="mt-6" :links="users.links" />
    
</template>
<script setup>
import Pagination from '../../Shared/Pagination';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';


let props = defineProps({
    users: Object,
    filters: Object,
    can: Object
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
  router.get('/users', { search: value }, { preserveState: true, replace: true });
}, 500));

</script>



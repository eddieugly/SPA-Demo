<template lang="">

            <h1 class="text-3xl">
            Create User
            </h1>

            <!-- component -->
<div class="flex items-center justify-center p-12">
  <div class="mx-auto w-full max-w-[550px]">
    <form @submit.prevent="submit">
      <div class="mb-5">
        <label
          for="name"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Full Name
        </label>
        <input
          v-model="form.name"
          type="text"
          name="name"
          id="name"
          placeholder="Full Name"
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          required
        />
        <div v-if="errors.name" v-text="errors.name" class="text-red-500 text-xs mt-1"></div>
      </div>
      <div class="mb-5">
        <label
          for="email"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Email Address
        </label>
        <input
          v-model="form.email"
          type="email"
          name="email"
          id="email"
          placeholder="example@domain.com"
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          required
        />
        <div v-if="errors.email" v-text="errors.email" class="text-red-500 text-xs mt-1"></div>
      </div>
      <div class="mb-5">
        <label
          for="password"
          class="mb-3 block text-base font-medium text-[#07074D]"
        >
          Password
        </label>
        <input
          v-model="form.password"
          type="password"
          name="password"
          id="password"
          placeholder="Enter your password"
          class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          required
        />
        <div v-if="errors.password" v-text="errors.password" class="text-red-500 text-xs mt-1"></div>
      </div>
      <div>
        <button
          class="hover:bg-blue-600 rounded-md bg-blue-500 py-2 px-6 text-base font-semibold text-white outline-none"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</div>

</template>
<script setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3'

defineProps({
  errors: Object
});

    let form = reactive({
        name: '',
        email: '',
        password: ''
    });

    let submit = () => {
        router.post('/users', form);
    };
</script>



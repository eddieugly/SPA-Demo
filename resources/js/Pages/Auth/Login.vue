<template>
  <!-- component -->
  <main>
    <section>
      <!-- component -->
      <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 w-11/12 p-12 sm:w-8/12 md:w-7/12 lg:w-6/12 mx-auto">
          <div
            class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
          </div>
          <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
              <div>
                <h1 class="text-2xl font-semibold">Login</h1>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <form @submit.prevent="submit">
                    <div class="mb-5">
                      <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                        Email:
                      </label>
                      <input v-model="form.email" type="email" name="email" id="email" placeholder="example@domain.com"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                      <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
                    </div>
                    <div class="mb-5">
                      <label for="password" class="mb-3 block text-base font-medium text-[#07074D]">
                        Password:
                      </label>
                      <input v-model="form.password" type="password" name="password" id="password"
                        placeholder="********"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                      <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1">
                      </div>
                    </div>
                    <div class="relative">
                      <button class="bg-blue-600 text-white rounded-md px-4 py-1 hover:bg-blue-700"
                        :disabled="form.processing">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>



</template>

<script>
export default {
  layout: null,
};
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';

defineProps({
  errors: Object
});

let form = useForm({
  email: '',
  password: ''
});

let submit = () => {
  form.post('/login');
};
</script>
<template>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img
            class="mx-auto h-10 w-auto"
            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company"
        />
        <h2
            class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
        >
            Sign in to your account
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" @submit="login">
            <div
                v-if="error"
                class="flex items-center justify-between py-3 px-5 mb-5 bg-red-500 text-white rounded"
            >
                {{ error }}
                <span
                    @click="error = ''"
                    class="cursor-pointer size-8 flex justify-center items-center rounded-full transition-colors hover:bg-[rgba(0,0,0,0.2)]"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>
                </span>
            </div>
            <div>
                <label
                    for="email"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Email address</label
                >
                <div class="mt-2">
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        v-model="user.email"
                    />
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label
                        for="password"
                        class="block text-sm font-medium leading-6 text-gray-900"
                        >Password</label
                    >
                </div>
                <div class="mt-2">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        v-model="user.password"
                    />
                </div>
                <div class="mt-2">
                    <input
                        type="checkbox"
                        id="remember-me"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        v-model="user.remember"
                    />
                    <label
                        for="remember-me"
                        class="ml-2 text-sm font-medium leading-6 text-gray-900"
                        >Remember me</label
                    >
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Sign in
                </button>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
            Not a member?
            <router-link
                :to="{ name: 'Register' }"
                class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                >Create account</router-link
            >
        </p>
    </div>
</template>

<script setup>
import { ref } from "vue";
import store from "../store";
import { useRouter } from "vue-router";
const router = useRouter();
let error = ref("");
const user = {
    email: "",
    password: "",
    remember: false,
};
function login(e) {
    e.preventDefault();
    store
        .dispatch("login", user)
        .then((res) => {
            router.push({ name: "Dashboard" });
        })
        .catch((err) => {
            error.value = err.response.data.error;
        });
}
</script>

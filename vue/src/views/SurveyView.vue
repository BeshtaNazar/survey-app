<template>
    <PageContentComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tex-gray-900">
                    {{ model.id ? model.title : "Create a Survey" }}
                </h1>
            </div>
        </template>
        <form @submit.prevent="saveSurvey">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Image</label
                        >
                        <div class="mt-1 flex items-center">
                            <img
                                v-if="model.image"
                                :src="model.image"
                                :alt="model.title"
                                class="w-64 h-48 object-cover"
                            />
                            <span
                                v-else
                                class="flex items-center justify-center size-12 rounded-full overflow-hidden bg-gray-100"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-[80%] text-gray-300"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                    />
                                </svg>
                            </span>
                            <div class="relative inline-block">
                                <button
                                    class="relative z-100 overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    @click="triggerFileInput"
                                >
                                    Change
                                    <input
                                        id="surveyImage"
                                        type="file"
                                        class="hidden"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /Image -->
                    <!-- Title -->
                    <div>
                        <label
                            for="title"
                            class="block text-sm font-medium text-gray-700"
                            >Title</label
                        >
                        <input
                            type="text"
                            name="title"
                            id="title"
                            v-model="model.title"
                            autocomplete="survey_title"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>
                    <!-- /Title -->
                    <!-- Description -->
                    <div>
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700"
                            >Description</label
                        >
                        <textarea
                            type="text"
                            name="description"
                            id="description"
                            v-model="model.description"
                            autocomplete="survey_description"
                            placeholder="Describe your survey"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>
                    <!-- /Description -->
                    <!-- Expire date -->
                    <div>
                        <label
                            for="expireDate"
                            class="block text-sm font-medium text-gray-700"
                            >Expire date</label
                        >
                        <input
                            type="date"
                            name="expireDate"
                            id="expireDate"
                            v-model="model.expireDate"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        />
                    </div>
                    <!-- /Expire date -->
                    <!-- Status -->
                    <div class="flex items-center">
                        <input
                            id="status"
                            name="status"
                            type="checkbox"
                            v-model="model.status"
                            class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded"
                        />
                        <label
                            for="status"
                            class="pl-3 text-base font-medium text-gray-700 select-none"
                            >Active</label
                        >
                    </div>
                    <!-- /Status -->
                </div>
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <h3
                        class="text-2xl font-semibold flex items-center justify-between"
                    >
                        Questions
                        <button
                            type="button"
                            @click="addQuestion()"
                            class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 mr-1"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4.5v15m7.5-7.5h-15"
                                />
                            </svg>
                            Add question
                        </button>
                    </h3>
                    <div
                        v-if="!model.questions.length"
                        class="text-center text-gray-600"
                    >
                        You don't have any questions added
                    </div>
                    <div
                        v-for="(question, index) in model.questions"
                        :key="question.id"
                    >
                        <QuestionEditor
                            :question="question"
                            :index="index"
                            @change="questionChange"
                            @addQuestion="addQuestion"
                            @deleteQuestion="deleteQuestion"
                        />
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button
                        type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </PageContentComponent>
</template>

<script setup>
import PageContentComponent from "../components/PageContentComponent.vue";
import QuestionEditor from "../components/editor/QuestionEditor.vue";
import { ref } from "vue";
import store from "../store";
import { useRoute } from "vue-router";
import { v4 as uuidv4 } from "uuid";
import { data } from "autoprefixer";

const route = useRoute();
let model = ref({
    title: "",
    status: false,
    description: null,
    image: null,
    expireDate: null,
    status: null,
    questions: [],
});
if (route.params.id) {
    model.value = store.state.surveys.find((s) => {
        s.id === parseInt(route.params.id);
    });
}
function triggerFileInput() {
    document.getElementById("surveyImage").click();
}
function addQuestion(index) {
    const newQuestion = {
        id: uuidv4(),
        type: "text",
        question: "",
        description: null,
        data: {},
    };
    model.value.questions.splice(index, 0, newQuestion);
}
function deleteQuestion(id) {
    model.value.questions = model.value.questions.filter((q) => q.id !== id);
}
function questionChange(question) {
    model.value.questions = model.value.questions.map((q) => {
        if (q.id === question.id) {
            return JSON.parse(JSON.stringify(question));
        }
        return q;
    });
}
</script>

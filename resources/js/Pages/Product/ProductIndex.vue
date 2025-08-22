<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const page = usePage();
</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Product
            </h2>
        </template>

        <!-- TODO : some stylings-->
        <div v-if="page.props.flash?.message" class="alert">
            {{ page.props.flash.message }}
        </div>

        <div class="p-12 space-y-6">
            <div class="flex justify-end px-6 mt-6">
                <PrimaryButton
                    :to="route('product.create')"
                    >Create Product</PrimaryButton
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>

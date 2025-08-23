<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const form=useForm({
    name:props.product.name,
    price:props.product.price,
    description:props.product.description,
});

const submit = () => {
    form.patch(route('product.update', props.product.id));

};
</script>

<template>
    <Head title="Update Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Update Product - {{ product.name }}
            </h2>
        </template>

        <div class="p-12 space-y-6">
            <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <InputLabel for="name">Name</InputLabel>
                        <TextInput
                            v-model="form.name"
                            id="name"
                            type="text"
                            class="block w-full mt-1"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <div v-if="form.errors.name" class="text-red-500">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div>
                        <InputLabel for="price">Price</InputLabel>
                        <TextInput
                            v-model="form.price"
                            id="price"
                            type="number"
                            class="block w-full mt-1"
                            required
                            autofocus
                        />
                        <div v-if="form.errors.price" class="text-red-500">
                            {{ form.errors.price }}
                        </div>
                    </div>
                    <div class="col-span-2">
                        <InputLabel for="name">Description</InputLabel>
                        <TextInput
                            v-model="form.description"
                            id="description"
                            type="text"
                            class="block w-full mt-1"
                            required
                            autofocus
                        />
                        <div v-if="form.errors.description" class="text-red-500">
                            {{ form.errors.description }}
                        </div>
                    </div>
                    <div>
                        <PrimaryButton>Save</PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

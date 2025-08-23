<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table";
import { Pencil, Trash2 } from "lucide-vue-next";

const page = usePage();
const { products } = defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const deleteProduct = (id) => {
    if (confirm("Are you sure you want to delete this product?")) {
        router.delete(route("product.destroy", id), {
            onSuccess: () => {
                // Refresh the page after deletion
                router.visit(route("product.index"));
            },
        });
    }
};
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
                <NavLink
                    :href="route('product.create')"
                    :class="'inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 hover:text-white focus:text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'"
                >
                    Create Product
                </NavLink>
            </div>

            <div class="border rounded-md">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>Created At</TableHead>
                            <TableHead class="text-right">Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="product in products" :key="product.id">
                            <TableCell class="font-medium">{{
                                product.name
                            }}</TableCell>
                            <TableCell>{{ product.description }}</TableCell>
                            <TableCell
                                >${{
                                    Number(product.price).toFixed(2)
                                }}</TableCell
                            >
                            <TableCell>{{ product.created_at }}</TableCell>
                            <TableCell class="text-right">
                                <div class="flex justify-end space-x-2">
                                    <Button
                                        variant="outline"
                                        size="sm"
                                        :to="route('product.edit', product.id)"
                                    >
                                        <Pencil class="w-4 h-4" />
                                    </Button>
                                    <Button
                                        variant="destructive"
                                        size="sm"
                                        @click="deleteProduct(product.id)"
                                    >
                                        <Trash2 class="w-4 h-4" />
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                        <TableRow v-if="products.length === 0">
                            <TableCell
                                colspan="5"
                                class="py-4 text-center text-muted-foreground"
                            >
                                No products found.
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

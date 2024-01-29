<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/inertia-vue3';

// Destructure the props object to get the 'sales' prop
const { sales } = defineProps(['sales']);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Sale List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice Discount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payable</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                <!-- You can add more columns based on your sale data structure -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="sale in sales" :key="sale.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ sale.customer }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ sale.invoiceDiscount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ sale.subtotal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ sale.payable }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ sale.created_at }}</td>
                                <!-- You can add more columns based on your sale data structure -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

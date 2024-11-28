<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import { Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/inertia';

defineProps(['promotions']);

const deletePromotion = (id) => {
    if (confirm('Are you sure you want to delete this promotion?')) {
        Inertia.delete(route('promotions.destroy', id));
    }
};
</script>

<template>
    <AppLayout title="Promotions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Promotions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">
                            Promotion List
                        </h3>
                        <Link
                            href="{{ route('promotions.create') }}"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow"
                        >
                            Create Promotion
                        </Link>
                    </div>

                    <!-- Table Section -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">
                                        Name
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">
                                        Description
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">
                                        Start Date
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-left">
                                        End Date
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        Status
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-right">
                                        Discount (%)
                                    </th>
                                    <th class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="promotion in promotions"
                                    :key="promotion.id"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                                >
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ promotion.name }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ promotion.description }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ promotion.startDate }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ promotion.endDate }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800': promotion.status,
                                                'bg-red-100 text-red-800': !promotion.status,
                                            }"
                                        >
                                            {{ promotion.status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-right">
                                        {{ promotion.discountPercentage }}%
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        <Link
                                            :href="route('promotions.edit', promotion.id)"
                                            class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="deletePromotion(promotion.id)"
                                            class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded ml-2"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="promotions.length === 0">
                                    <td
                                        colspan="7"
                                        class="px-4 py-2 text-center text-gray-500 dark:text-gray-400"
                                    >
                                        No promotions found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

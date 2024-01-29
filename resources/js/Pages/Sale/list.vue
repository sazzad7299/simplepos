<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Sales List</h1>

      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
            <!-- Add other table headers for additional sale properties -->
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="sale in sales" :key="sale.id">
            <td class="px-6 py-4 whitespace-nowrap">{{ sale.customer }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ sale.payable }}</td>
            <!-- Add other table cells for additional sale properties -->
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  <script>
export default {
  props: {
    sales: {
      type: Array,
      default: () => [],
    },
  },
};
</script>


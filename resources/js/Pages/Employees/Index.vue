<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

interface Employee {
  id: number
  name: string
  email: string
  position: string
  department: string
  hire_date: string
}

const props = defineProps<{
  employees: Employee[]
}>()
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Employees" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Employees
      </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2">Employees</h1>

                <div class="mb-6">
                    <Link
                    :href="route('employees.create')"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md shadow-sm
                            border border-transparent bg-indigo-600 text-white
                            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                    + Add Employee
                    </Link>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Email
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Position
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Department
                                </th>
                                <th
                                    scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Date Hired
                                </th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="employee in props.employees"
                                :key="employee.id"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ employee.name }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ employee.email }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ employee.position }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ employee.department }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ employee.hire_date }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    <Link
                                        :href="route('employees.edit', employee.id)"
                                        class="text-indigo-600 hover:text-indigo-900 font-medium"
                                    >
                                    Edit
                                    </Link>
                                </td>
                            </tr>

                            <!-- Empty state -->
                            <tr v-if="!props.employees.length">
                                <td
                                    colspan="5"
                                    class="px-4 py-6 text-center text-sm text-gray-500"
                                >
                                    No employees found. Click “Add Employee” to create one.
                                </td>
                            </tr>
                        </tbody>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
  </AuthenticatedLayout>
</template>

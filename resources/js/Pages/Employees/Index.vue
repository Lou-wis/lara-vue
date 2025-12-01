<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
const Swal: any = (window as any).Swal

interface Employee {
  id: number
  name: string
  email: string
  position: string
  department: string
  hire_date: string
}

interface Department {
  id: number
  department_name: string
}

const props = defineProps<{
  employees: Employee[]
  departments: Department[]
}>()

const showCreateModal = ref(false)

const form = useForm({
  name: '',
  email: '',
  position: '',
  department_id: '',
  hire_date: '', 
})

const openModal = () => {
  showCreateModal.value = true
}

const closeModal = () => {
  showCreateModal.value = false
  form.reset()
  form.clearErrors()
}

const submit = () => {
  form.post(route('employees.store'), {
    onSuccess: () => {
      closeModal()

      Swal.fire({
        icon: 'success',
        title: 'Employee added',
        text: 'The employee has been saved successfully.',
        timer: 2000,
        showConfirmButton: false,
      })
    },
  })
}
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
                    <button
                        type="button"
                        @click="openModal"
                        class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md shadow-sm
                            border border-transparent bg-indigo-600 text-white
                            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        + Add Employee
                    </button>
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

    <!-- Modal -->
    <div
      v-if="showCreateModal"
      class="fixed inset-0 z-50 flex items-center justify-center"
    >
      <!-- Backdrop -->
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75" @click="closeModal"></div>

      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
          <h3 class="text-lg font-medium text-gray-900">
            Add Employee
          </h3>
          <button
            type="button"
            class="text-gray-400 hover:text-gray-600"
            @click="closeModal"
          >
            ✕
          </button>
        </div>

        <form @submit.prevent="submit" class="px-6 py-4 space-y-4">
          <!-- Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input
              v-model="form.name"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            />
            <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">
              {{ form.errors.name }}
            </p>
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input
              v-model="form.email"
              type="email"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            />
            <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">
              {{ form.errors.email }}
            </p>
          </div>

          <!-- Position -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Position</label>
            <input
              v-model="form.position"
              type="text"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            />
            <p v-if="form.errors.position" class="mt-1 text-sm text-red-600">
              {{ form.errors.position }}
            </p>
          </div>

          <!-- Department -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Department</label>
            <select
              v-model="form.department_id"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
              <option value="">Select a department</option>
              <option
                v-for="dept in props.departments"
                :key="dept.id"
                :value="dept.id"
              >
                {{ dept.department_name }}
              </option>
            </select>
            <p v-if="form.errors.department_id" class="mt-1 text-sm text-red-600">
              {{ form.errors.department_id }}
            </p>
          </div>

          <!-- Hire Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Hire Date</label>
            <input
              v-model="form.hire_date"
              type="date"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                     focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            />
            <p v-if="form.errors.hire_date" class="mt-1 text-sm text-red-600">
              {{ form.errors.hire_date }}
            </p>
          </div>

          <!-- Actions -->
          <div class="flex justify-end gap-2 pt-2">
            <button
              type="button"
              @click="closeModal"
              class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md
                     border border-gray-300 text-gray-700 bg-white
                     hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-md shadow-sm
                     border border-transparent bg-indigo-600 text-white
                     hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
                     disabled:opacity-50"
            >
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

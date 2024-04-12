<script setup>

defineProps({
  tasks: Array
})

</script>

<template>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Status</th>
        <th>Success Count</th>
        <th>Errors Count</th>
        <th>Created At</th>
        <th>Finished At</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="task in tasks" :key="task.id">
        <td data-label="ID">
          {{ task.id }}
        </td>
        <td data-label="Status">
          {{ task.statusName }}
        </td>
          <td data-label="Status">
              {{ task.success_count }}
          </td>
          <td data-label="Status">
              {{ task.errors_count }}
          </td>
          <td data-label="Created At">
              {{ task.created_at }}
          </td>
          <td data-label="Finished At">
              {{ task.finished_at }}
          </td>
      </tr>
    </tbody>
  </table>
</template>

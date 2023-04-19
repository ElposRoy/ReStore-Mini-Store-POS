<script setup>
import InputError from '@/Components/InputError.vue';

defineEmits(['deleteItemConfirm','closeDelete'])

defineProps(['dialogDelete','purchases','deleteId']);
</script>


<template>
    <!-- Delete Dialog -->
    <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item? </v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="$emit('closeDelete')">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="$emit('deleteItemConfirm')">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
<!-- Delete Dialog -->
</template>
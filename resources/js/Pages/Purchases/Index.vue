<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductAddDialog from '@/Components/product/ProductAddDialog.vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import InputError from '@/Components/InputError.vue';
import { router } from '@inertiajs/vue3'
import {useForm, Head } from '@inertiajs/vue3';

</script>

<script>

</script>
 
<template>
    <Head title="Purchases" />
 
    <AuthenticatedLayout>
     
        <v-card
    class="mx-auto"
    width="400"
    prepend-icon="mdi-home"
  >
    <template v-slot:title>
      This is a titlesds
    </template>

    <v-card-text>
      This is content
    </v-card-text>
  </v-card>
   
  
    </AuthenticatedLayout>
</template>
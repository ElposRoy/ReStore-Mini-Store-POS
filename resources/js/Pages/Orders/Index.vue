<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { VDataTable } from 'vuetify/labs/VDataTable'
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['products','categories','unit_types']);
</script>

<script>
  export default {
    data: () => ({
      items: [
        {
          title: 'Item #1',
          value: 1,
        },
        {
          title: 'Item #2',
          value: 2,
        },
        {
          title: 'Item #3',
          value: 3,
        },
        {
          title: 'Item #4',
          value: 4,
        },
        
      ],
    }),
  }
</script>

<template>
    <Head title="Orders" />
 
    <AuthenticatedLayout>
     <div class="m-2">
      <v-row>
                  <v-col cols="12" sm="2" md="2"
                  >
                  <v-card
    class="mx-auto "
    
    max-width="300"
  >
  <template v-slot:title>
                    CATEGORIES
                  </template>
    <v-list :items="items"></v-list>
  </v-card>
                    
                  </v-col>

                  <v-col cols="12" sm="7" md="7"
                  >
               <v-card class="mx-auto" prepend-icon="mdi-home">
                  <template v-slot:title>
                    SELECTION OF PRODUCTS
                  </template>

                  <v-card-text>
                    This is content
                  </v-card-text>
                </v-card>
                   
                  </v-col>

                  <v-col cols="12" sm="3" md="3" >
                 <v-card
                    class="mx-auto"
                    
                    prepend-icon="mdi-home"
                  >
                    <template v-slot:title>
                      CART AREA
                    </template>

                    <v-card-text>
                      This is content
                    </v-card-text>
                  </v-card>
                    
                  </v-col>
                  </v-row>
     </div>
           
                  
    </AuthenticatedLayout>
    
    
</template>
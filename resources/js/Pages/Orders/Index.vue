<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['categories']);

const selectedCategory = useForm ({
  categoryId : null,
});
</script>

<script>

  export default {
    data: () => ({
    
  
    }),
    
  computed: {

  },
  watch: {
    
  },

  methods: {
    selectCategory(item){
      console.log(item)
    }
  },
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
  <v-card-text class="bg-red-darken-4"> CATEGORIES</v-card-text>

  
    <v-list
      v-model="selectedCategory.categoryId"
      height="500" class="overflow-auto "
      :items="categories"
      item-title="title"
      item-value="id"
      @click="selectCategory()"
    ></v-list>

  </v-card>
                    
                  </v-col>

                  <v-col cols="12" sm="7" md="7"
                  >
               <v-card class="mx-auto" prepend-icon="mdi-archive">
                  <template v-slot:title>
                    PRODUCTS
                  </template>

                  <v-card-text>
                    This is content
                  </v-card-text>
                </v-card>
                   
                  </v-col>

                  <v-col cols="12" sm="3" md="3" >
                 <v-card
                    class="mx-auto"
                    
                    prepend-icon="mdi-basket"
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
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
    // props: ['categories'], <-- You can also use this props instead of the top defineProps
    // Use Created for consoling when refreshed or reloaded
    created() {
    // props are exposed on `this`.
    console.log(this.categories);

  
  },


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
        <v-col cols="12" sm="2" md="2">
        <v-card  class="mx-auto " max-width="300">
  <v-card-text class="bg-red-darken-4"> CATEGORIES</v-card-text>
  <v-list v-model="selectedCategory.categoryId" height="500" class="overflow-auto">  <!-- V-list container -->
    <!-- V-list-item and for loop all of the category id.-->
    <!-- :value="category.id" is for getting the ID instead of the title. -->
    <v-list-item 
      v-for="(category) in categories"
      :key="category.id"
      :value="category.id"
      @click="selectCategory(category.id)"
    >
      {{ category.title }}  <!-- Show the title instead of the ID-->
    </v-list-item>
  </v-list>
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
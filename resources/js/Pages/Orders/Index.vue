<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3'
import { useForm, Head } from '@inertiajs/vue3';
defineProps(['categories','products']);

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
    // console.log(this.products.id);

  
  },


    data: () => ({
      cards: [
        { title: 'Pre-fab homes', src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg'},
        { title: 'Favorite road trips', src: 'https://cdn.vuetifyjs.com/images/cards/road.jpg'},
        { title: 'Best airlines', src: 'https://cdn.vuetifyjs.com/images/cards/plane.jpg'},
    ],
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
  <v-card-text class="bg-red-darken-4" > CATEGORIES</v-card-text>
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
               <v-card class="mx-auto" color="orange-lighten-4" prepend-icon="mdi-archive">
                  <template  v-slot:title>
                    <div>PRODUCTS</div>
                  </template>

                  <v-divider :thickness="8" class="border-opacity-100"></v-divider>

                  <v-card
    class="mx-auto"
    
  >
  
    <v-container fluid>
      <v-row dense>
        <v-col
  v-for="product in products"
  :key="product.product_name"
  :value="product.id"
  cols="4"
>
  <v-card>
    <v-img 
      :src="'http://127.0.0.1:8000/'+product.image"
      class="align-end"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
     
      height="200px"
      cover
    >
      <v-card-title class="text-white" v-text="product.product_name"></v-card-title>
    </v-img>

    <v-card-actions>
      <v-spacer></v-spacer>

      <v-btn size="small" color="surface-variant" variant="text" icon="mdi-heart"></v-btn>

      <v-btn size="small" color="surface-variant" variant="text" icon="mdi-bookmark"></v-btn>

      <v-btn size="small" color="surface-variant" variant="text" icon="mdi-share-variant"></v-btn>
    </v-card-actions>
  </v-card>
</v-col>

      </v-row>
    </v-container>
  </v-card>

  
                  
                </v-card>
                   
                  </v-col>

                  <v-col cols="12" sm="3" md="3" >
                 <v-card
                    class="mx-auto"
                    color="green-lighten-5"
                    prepend-icon="mdi-basket"
                  >
                    <template v-slot:title>
                      CART AREA
                    </template>
                    <v-divider :thickness="8" class="border-opacity-100"></v-divider>
                    
                    
                    
                  </v-card>
                    
                  </v-col>
                  </v-row>
     </div>
           
                  
    </AuthenticatedLayout>
    
    
</template>
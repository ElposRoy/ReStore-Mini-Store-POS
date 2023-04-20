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
    // console.log(this.products.data);

  
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
      <v-row >
       

        <v-col cols="12" sm="8" md="8" >
          <v-card class="mx-auto">
            <!-- Fix the categories. It should be a box bg color light blue and has horizontal scrollbar  -->
            <v-col cols="12" sm="12" md="12">
              CATEGORIES
              <v-list v-model="selectedCategory.categoryId">
  <!-- V-list container -->
  <!-- V-list-item and for loop all of the category id.-->
  <!-- :value="category.id" is for getting the ID instead of the title. -->
  <v-row>
    <v-list-item 
      v-for="(category) in categories"
      :key="category.id"
      :value="category.id"
      @click="selectCategory(category.id)"
    >
      {{ category.title }} <!-- Show the title instead of the ID-->
    </v-list-item>
  </v-row>
</v-list>

            </v-col>
          <v-divider :thickness="8" class="border-opacity-100"></v-divider>
 
            <v-card
            class="mx-auto"
            >
  
            <v-container fluid>
              <v-row dense>
                 <!-- Change the product to purchase Props that comes with the price-->
                <v-col
          v-for="product in products.data" 
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

            <v-card-actions v-for="purchase in product.purchases" :key="purchase.id" >
              
                <v-card-text >
                    {{ product.unit}} Unit
                  </v-card-text>

                  <v-card-text >
                    ₱ {{ purchase.sale_price }}
                  </v-card-text>
                  
              <v-btn prepend-icon="mdi mdi-plus-box" variant="tonal" color="success">
                ADD
              </v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-col>

      </v-row>
    </v-container>
  </v-card>

  
                  
                </v-card>
                   
                  </v-col>

                  <v-col cols="12" sm="4" md="4" >
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
